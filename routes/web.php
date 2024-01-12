<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\SoapController;
use App\Http\Controllers\GraphQLController;
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


Route::get('/marketplace', [CarController::class, 'index'])->name('marketplace');
Route::get('/marketplace/forsale', [CarController::class, 'getForSale']);
Route::get('/marketplace/filtered', [CarController::class, 'getFiltered'])->name('filtered');
Route::get('/marketplace/newCar', function () {return view('newcar');})->name('newCar');
Route::post('/marketplace/newCar', [CarController::class, 'create'])->name('car.create');

Route::get('/callSoapService', [SoapController::class, 'callSoapService'])->name('callSoapService');
Route::get('/calendar/getAllRallies', [SoapController::class, 'getAllRallies'])->name('getRallies');
Route::get('/calendar/getAllFutureRallies', [SoapController::class, 'getAllFutureRallies'])->name('getFutureRallies');
Route::get('/calendar/getRallyByName', [SoapController::class, 'getRallyByName'])->name('getallyByName');
Route::get('/calendar/getRalliesByLocation/{longitude}/{latitude}', [SoapController::class, 'getRalliesByLocation'])->name('getRalliesByLocation');

Route::get('/wrc', function () {return view('graphql/graphql');})->name('graphqlSearch');
Route::get('/wrc/graphql/getAllTeams', function () {return view('graphql/shortteams');});
Route::get('/wrc/graphql/getAllTeamsWithParticipants', function () {return view('graphql/teams');});
Route::get('/wrc/graphql/getAllPodiums', function () {return view('graphql/podiums');});
Route::get('/wrc/graphql/getRallyByName', function () {return view('graphql/rally');});
Route::get('/wrc/graphql/getParticipantsByNames', function () {return view('graphql/particpants');});
Route::get('/wrc/graphql/getTeamByName', function () {return view('graphql/teams');});
Route::get('/wrc/graphql/getSeasonByYear', function () {return view('graphql/season');});

Route::get('cloudrallycommunication', function () {return view('websockets/chat');})->name('chat');

Route::get('/trackcondition', function () {return view('map');});
Route::get('/test', function () {return view('season');});
Route::get('/', function () {return view('welcome');})->name('index');

