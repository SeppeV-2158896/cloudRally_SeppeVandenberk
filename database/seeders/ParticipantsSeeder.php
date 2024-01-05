<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Participant;

class ParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Participant::truncate();

        $csvFile = fopen('C:\xampp\htdocs\cloudRally_SeppeVandenberk\database\data\participants.csv', "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {

            if (!$firstline) {

                Participant::create([

                    'first_name'=> $data[1],
                    'last_name' => $data[2],
                    'birthday'  => $data[3],

                ]);    

            }

            $firstline = false;

        }

   

        fclose($csvFile);
    }
}
