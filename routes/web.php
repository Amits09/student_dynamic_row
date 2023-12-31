<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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
    return view('student_form');
});


Route::get('/dashboard',[StudentController::class,'index']);

Route::post('/submit',[StudentController::class,'submit']);
Route::post('/fetch-states', [StudentController::class, 'fetchState']);

