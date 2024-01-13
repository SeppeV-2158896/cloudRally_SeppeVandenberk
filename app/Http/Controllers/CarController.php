<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Psy\Readline\Hoa\Console;

class CarController extends Controller
{

    public function index()
    {
        $cars = Car::all();
        return view('REST/cars', ['cars' => $cars]);
    }
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

    public function getForSale(Request $request){
        $cars = Car::all()->where('sold', false);
        return view('REST/cars', ['cars' => $cars]);
    }
    

    public function getFiltered(Request $request){
        $cars = Car::all();
        if ($request->minPrice != null) {
            $cars = $cars->where('price','>', $request->minPrice);
        }
        if ($request->maxPrice != null) {
            $cars = $cars->where('price','<', $request->maxPrice);
        }
        if ($request->kilometersRange  != null) {
            $cars = $cars->where('kilometersDriven','<', $request->kilometersRange);
        }      
        if ($request->brand  != null) {
            $cars = $cars->where('carBrand', $request->brand);
        }
        if ($request->model  != null) {
            $cars = $cars->where('name', $request->model);
        }
        if ($request->gasType != null) {
            $cars = $cars->where('fuelType', $request->gasType);
        }

        $cars = $cars->where('sold', false);

        return view('REST/cars', ['cars' => $cars]);
    }

    


}
