<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\User;

class BuildingController
{
    public function index()
    {
        $buildings = Building::with('owner')->orderBy('id','desc')->paginate(20);
        return view('admin.buildings.index', compact('buildings'));
    }

    public function create()
    {
        $owners = User::whereHas('roles', function ($q) { $q->where('name','owner'); })->get();
        return view('admin.buildings.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'address' => 'nullable|string|max:1000',
            'owner_id' => 'required|exists:users,id',
        ]);

        Building::create($data);

        return redirect()->route('admin.buildings.index')->with('success','Building created.');
    }

    public function show(Building $building)
    {
        $building->load('owner','flats');
        return view('admin.buildings.show', compact('building'));
    }

    public function edit(Building $building)
    {
        $owners = User::whereHas('roles', function ($q) { $q->where('name','owner'); })->get();
        return view('admin.buildings.edit', compact('building','owners'));
    }

    public function update(Request $request, Building $building)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'address' => 'nullable|string|max:1000',
            'owner_id' => 'required|exists:users,id',
        ]);

        $building->update($data);

        return redirect()->route('admin.buildings.show', $building)->with('success','Building updated.');
    }

    public function destroy(Building $building)
    {
        $building->delete();
        return redirect()->route('admin.buildings.index')->with('success','Building deleted.');
    }
}
