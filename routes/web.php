<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

use App\Models\Car;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/marketplace', function() {
    $cars = Car::all();
    return view('cars',['cars' => $cars]);
})->name('index');
Route::get('/marketplace/newCar', function () {return view('newcar');});
Route::post('/marketplace/newCar', [CarController::class, 'create'])->name('car.create');
Route::get('/trackcondition', function () {return view('map');});

Route::get('/test', function () {return view('test');});
Route::get('/', function () {return view('welcome');});

