<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedisImportController;
use App\Http\Controllers\SchoolController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/import-csv', [RedisImportController::class, 'importCSV']);
Route::get('/schools/grouped', [SchoolController::class, 'groupBySchool']);
