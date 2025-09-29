<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlatController extends Controller
{
    // List flats belonging to current owner
    public function index()
    {
        $user = Auth::user();

        $flats = Flat::with('building')
            ->where('owner_id', $user->id)
            ->paginate(20);

        return view('owner.flats.index', compact('flats'));
    }

    // Show create form
    public function create()
    {
        $user = Auth::user();
        // Load only the owner’s buildings
        $buildings = Building::where('owner_id', $user->id)->get();

        return view('owner.flats.create', compact('buildings'));
    }

    // Store new flat
    public function store(Request $request)
    {
        $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'flat_number' => 'required|string|max:50|unique:flats,flat_number,NULL,id,building_id,' . $request->building_id,
            'flat_owner_name' => 'nullable|string|max:191',
            'flat_owner_contact' => 'nullable|string|max:50',
            'flat_owner_email' => 'nullable|email|max:191',
        ]);

        $user = Auth::user();

        Flat::create([
            'building_id' => $request->building_id,
            'owner_id' => $user->id,
            'flat_number' => $request->flat_number,
            'flat_owner_name' => $request->flat_owner_name,
            'flat_owner_contact' => $request->flat_owner_contact,
            'flat_owner_email' => $request->flat_owner_email,
        ]);

        return redirect()->route('owner.flats.index')->with('success', 'Flat created.');
    }

    // Show a single flat
    public function show(Flat $flat)
    {
        $this->assertOwnerAccess($flat->owner_id);

        $flat->load('building');

        return view('owner.flats.show', compact('flat'));
    }

    // Show edit form
    public function edit(Flat $flat)
    {
        $this->assertOwnerAccess($flat->owner_id);

        $user = Auth::user();
        $buildings = Building::where('owner_id', $user->id)->get();

        return view('owner.flats.edit', compact('flat', 'buildings'));
    }

    // Update flat
    public function update(Request $request, Flat $flat)
    {
        $this->assertOwnerAccess($flat->owner_id);

        $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'flat_number' => 'required|string|max:50|unique:flats,flat_number,' . $flat->id . ',id,building_id,' . $request->building_id,
            'flat_owner_name' => 'nullable|string|max:191',
            'flat_owner_contact' => 'nullable|string|max:50',
            'flat_owner_email' => 'nullable|email|max:191',
        ]);

        $flat->update($request->only([
            'building_id',
            'flat_number',
            'flat_owner_name',
            'flat_owner_contact',
            'flat_owner_email',
        ]));

        return redirect()->route('owner.flats.index')->with('success', 'Flat updated.');
    }

    // Delete flat
    public function destroy(Flat $flat)
    {
        $this->assertOwnerAccess($flat->owner_id);

        $flat->delete();

        return redirect()->route('owner.flats.index')->with('success', 'Flat deleted.');
    }

    // Owner access check
    protected function assertOwnerAccess($ownerId)
    {
        $user = Auth::user();

        if ($user->id === (int) $ownerId) {
            return;
        }

        if (isset($user->roles) && $user->roles->pluck('name')->contains('admin')) {
            return; // admin bypass
        }

        abort(403, 'Unauthorized.');
    }
}
