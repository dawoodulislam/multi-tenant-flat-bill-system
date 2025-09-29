<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\BillCategory;
use App\Models\User;

class BillCategorySeeder extends Seeder
{
    public function run()
    {
        $owner = User::where('email','owner1@example.com')->first();

        $categories = ['Electricity','Gas bill','Water bill','Utility Charges'];
        foreach($categories as $c) {
            BillCategory::create(['name'=>$c,'owner_id'=>$owner->id]);
        }
    }
}
