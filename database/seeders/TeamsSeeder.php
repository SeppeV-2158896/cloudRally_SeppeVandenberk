<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::truncate();

        $csvFile = fopen('C:\xampp\htdocs\cloudRally_SeppeVandenberk\database\data\teams.csv', "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {

            if (!$firstline) {

                Team::create([

                    'name'=> $data[2],
                    'pilot'=> $data[0],
                    'copilot'=> $data[1],
                    'car'=> $data[3],
                    'constructor'=> $data[4],

                ]);    

            }

            $firstline = false;

        }

   

        fclose($csvFile);
    }
}
