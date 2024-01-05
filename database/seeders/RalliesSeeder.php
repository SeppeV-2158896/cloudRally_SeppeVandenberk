<?php

namespace Database\Seeders;

use App\Models\Rally;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RalliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Rally::truncate();

        $csvFile = fopen('C:\xampp\htdocs\cloudRally_SeppeVandenberk\database\data\rallies.csv', "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {

            if (!$firstline) {

                Rally::create([

                    'name'      => $data[0],
                    'location'  => $data[1],
                    'start_date'=> $data[2],
                    'end_date'  => $data[3],
                    'winner'    => $data[4],
                    'second_place'  => $data[5],
                    'third_place'=> $data[6],
                    'interval_second'=> $data[7],
                    'interval_third'    => $data[8],
                    'season_id' => $data[9],

                ]);    

            }

            $firstline = false;

        }

   

        fclose($csvFile);
        
        

    }
}
