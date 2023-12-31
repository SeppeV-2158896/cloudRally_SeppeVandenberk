<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class carsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        foreach (range(1, 14) as $index) {
            

        $json = file_get_contents('https://api.unsplash.com/photos/random?client_id=tE7UOZI-TDa9p_z6KPlwNVO9y58FkbkO3NJ3ivX10qE&query=rallycar');
        $obj = json_decode($json);
        
        $url =  (string) $obj->urls->regular;

            DB::table('cars')->insert([
                'name'=> $faker->vehicleModel,
                'carBrand' => $faker->vehicleBrand,
                'buildYear' => random_int(1950,2023),
                'kilometersDriven' => random_int(45000,120000),
                'sold' => (bool) random_int(0,1),
                'price' => ((double) random_int(700000,25000000))/100,
                'imgURL' => $url,
                'gearboxType' => $faker->vehicleGearBoxType,
                'fuelType' => $faker->vehicleFuelType,
                'amountOfDoors' => $faker->vehicleDoorCount,
            ]);
        }
    }
}
