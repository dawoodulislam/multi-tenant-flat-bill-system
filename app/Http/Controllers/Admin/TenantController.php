<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Building;
use App\Models\Flat;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('building','flat')->paginate(25);
        return view('admin.tenants.index', compact('tenants'));
    }

    public function create()
    {
        $buildings = Building::with('flats')->get();
        return view('admin.tenants.create', compact('buildings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'nullable|email',
            'building_id'=>'required|exists:buildings,id',
            'flat_id'=>'nullable|exists:flats,id',
        ]);

        Tenant::create($request->only(['user_id','name','contact','email','building_id','flat_id']));
        return redirect()->route('admin.tenants.index')->with('success','Tenant created.');
    }

    public function show(Tenant $tenant)
    {
        return view('admin.tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant)
    {
        $buildings = Building::with('flats')->get();
        return view('admin.tenants.edit', compact('tenant','buildings'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'nullable|email',
            'building_id'=>'required|exists:buildings,id',
            'flat_id'=>'nullable|exists:flats,id',
        ]);

        $tenant->update($request->only(['name','contact','email','building_id','flat_id']));
        return redirect()->route('admin.tenants.index')->with('success','Tenant updated.');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return back()->with('success','Tenant removed.');
    }
}
