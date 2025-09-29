<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Building;
use App\Models\Flat;
use App\Models\User;

class BuildingFlatSeeder extends Seeder
{
    public function run()
    {
        $owner = User::where('email','owner1@example.com')->first();
        $building = Building::create([
            'name' => 'Owner1 Building',
            'address' => '123 Example Road',
            'owner_id' => $owner->id,
        ]);

        // create sample flats
        for ($i=1;$i<=10;$i++) {
            Flat::create([
                'building_id' => $building->id,
                'owner_id' => $owner->id,
                'flat_number' => 'A'.$i,
                'flat_owner_name' => null,
            ]);
        }
    }
}
