<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Season::truncate();

        $csvFile = fopen('C:\xampp\htdocs\cloudRally_SeppeVandenberk\database\data\seasons.csv', "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {

            if (!$firstline) {

                Season::create([

                    'year' => $data[0],
                    'champion'=> $data[1],
                    'constructor_champion'=> $data[2],

                ]);    

            }

            $firstline = false;

        }

   

        fclose($csvFile);
    }
}
