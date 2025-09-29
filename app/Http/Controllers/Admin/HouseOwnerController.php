<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class HouseOwnerController extends Controller
{
    public function index()
    {
        $owners = User::whereHas('roles', function ($q) {
            $q->where('name', 'owner');
        })->paginate(20);
        return view('admin.houseowners.index', compact('owners'));
    }

    public function create()
    {
        return view('admin.houseowners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $owner = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $ownerRole = Role::where('name','owner')->first();

        $owner->roles()->attach($ownerRole);

        return redirect()->route('admin.houseowners.index')->with('success','Owner created');
    }

    public function edit(User $houseowner)
    {
        return view('admin.houseowners.edit', compact('houseowner'));
    }

    public function update(Request $request, User $houseowner)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email,'.$houseowner->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = $request->only(['name','email']);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $houseowner->update($data);

        return redirect()->route('admin.houseowners.index')->with('success','Owner updated');
    }

    public function destroy(User $houseowner)
    {
        $houseowner->delete();
        return redirect()->route('admin.houseowners.index')->with('success','Owner deleted');
    }
}
