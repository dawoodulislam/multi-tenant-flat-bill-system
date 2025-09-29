<?php
namespace App\Http\Controllers\Owner;

use Log;
use App\Models\Bill;
use App\Models\Flat;
use App\Mail\BillPaid;
use App\Models\Building;
use App\Mail\BillCreated;
use App\Models\BillCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BillController extends Controller
{
    public function index()
    {
        $owner = Auth::user();
        $bills = Bill::where('owner_id', $owner->id)
                     ->with(['flat','building','category','payments'])
                     ->orderBy('month','desc')
                     ->paginate(25);

        return view('owner.bills.index', compact('bills'));
    }

    public function create()
    {
        $owner = Auth::user();
        $buildings = $owner->buildings()->with('flats')->get();
        $categories = BillCategory::where('owner_id', $owner->id)->get();
        return view('owner.bills.create', compact('buildings','categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'flat_id' => 'required|exists:flats,id',
            'bill_category_id' => 'required|exists:bill_categories,id',
            'month' => 'required|date',
            'amount' => 'required|numeric|min:0',
        ]);

        $owner = Auth::user();

        // carry previous unpaid sum if desired (simple example)
        $prevUnpaid = Bill::where('flat_id', $request->flat_id)
                          ->where('status','unpaid')
                          ->sum('amount');

        $bill = Bill::create([
            'owner_id' => $owner->id,
            'building_id' => $request->building_id,
            'flat_id' => $request->flat_id,
            'bill_category_id' => $request->bill_category_id,
            'month' => $request->month,
            'amount' => $request->amount,
            'status' => 'unpaid',
            'due_previous' => $prevUnpaid,
            'notes' => $request->notes,
        ]);

        // optional: send email (Mailables should exist)
        Mail::to($owner->email)->send(new BillCreated($bill));

        return redirect()->route('owner.bills.index')->with('success', 'Bill created.');
    }

    public function show(Bill $bill)
    {
        $this->assertOwner($bill->owner_id);
        $bill->load('payments','flat','category','building');
        return view('owner.bills.show', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        $this->assertOwner($bill->owner_id);
        $categories = BillCategory::where('owner_id', Auth::id())->get();
        return view('owner.bills.edit', compact('bill','categories'));
    }

    public function update(Request $request, Bill $bill)
    {
        $this->assertOwner($bill->owner_id);

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|in:paid,unpaid',
        ]);

        $bill->update($request->only(['amount','notes','status']));
        return redirect()->route('owner.bills.show', $bill)->with('success','Bill updated.');
    }

    public function destroy(Bill $bill)
    {
        $this->assertOwner($bill->owner_id);
        $bill->delete();
        return redirect()->route('owner.bills.index')->with('success','Bill deleted.');
    }

    // custom action to record a payment
    public function pay(Request $request, Bill $bill)
    {
        $this->assertOwner($bill->owner_id);

        $owner = Auth::user();

        $request->validate(['amount' => 'required|numeric|min:0.01']);

        $amount = $request->input('amount');

        // simple mark paid (uses Bill::markPaid helper in earlier model)
        $bill->markPaid($amount, Auth::id(), $request->input('reference'));

        // send email notification to stakeholders: owner + flat owner email (if present)
        try {
            Mail::to($owner->email)->send(new BillPaid($bill));
            if ($bill->flat->flat_owner_email) {
                Mail::to($bill->flat->flat_owner_email)->send(new BillPaid($bill));
            }
        } catch (\Exception $e) {
            // log but don't fail
            Log::error('Mail error: '.$e->getMessage());
        }

        return redirect()->route('owner.bills.show', $bill)->with('success','Payment recorded.');
    }

    protected function assertOwner($ownerId)
    {
        if (Auth::id() !== (int)$ownerId && !Auth::user()->hasRole('admin')) {
            abort(403);
        }
    }
}
