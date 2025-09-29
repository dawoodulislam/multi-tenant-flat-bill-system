<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = ['admin'=>'Super Admin','owner'=>'House Owner','tenant'=>'Tenant'];
        
        foreach($roles as $name=>$label) {
            Role::firstOrCreate(['name'=>$name], ['label'=>$label]);
        }
    }
}
