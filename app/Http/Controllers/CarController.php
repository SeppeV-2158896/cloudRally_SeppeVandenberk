<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function create(Request $request){
        $this->validate($request, [
            'car_name' => 'required',
        ]);

        $car = new Car;
        $car->name = $request->car_name;
        $car->sold = false; 
        $car->carBrand = $request->car_brand;
        $car->buildYear = $request->build_year;
        $car->kilometersDriven = $request->kilometers_driven;
        $car->price = $request->price; 
        $car->imgURL = $request->img_url;
        $car->gearboxType = $request->gearbox_type;
        $car->fuelType = $request->fuel_type;
        $car->amountOfDoors = $request->amount_of_doors;

        $car->save();   

        return redirect()->route('index');
    }
}
