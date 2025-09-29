<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name'=>'Super Admin',
            'email'=>'admin@example.com',
            'password'=>Hash::make('password')
        ]);
        $owner = User::create([
            'name'=>'House Owner 1',
            'email'=>'owner1@example.com',
            'password'=>Hash::make('password')
        ]);
        $tenantUser = User::create([
            'name'=>'Tenant User',
            'email'=>'tenant1@example.com',
            'password'=>Hash::make('password')
        ]);

        $adminRole = Role::where('name','admin')->first();
        $ownerRole = Role::where('name','owner')->first();
        $tenantRole = Role::where('name','tenant')->first();

        $admin->roles()->attach($adminRole);
        $owner->roles()->attach($ownerRole);
        $tenantUser->roles()->attach($tenantRole);
    }
}
