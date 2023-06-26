<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;

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

Route::get('/', function () { # TODO Придумать стартовую страницу
    return view('welcome');
});

Route::get('/auth', function (){
    return view('auth');
});

Route::get('/grades', function (){
    return view('grades');
});

Route::get('/groups', function (){
    return view('groups');
});

Route::get('/students', function (){
    return view('students.students');
});

Route::get('/students/create', function (){
    return view('students.create');
});

Route::get('/subjects', function (){
    return view('subjects');
});

Route::get('/teachers', function (){
    return view('teachers');
});

Route::resource('students', StudentController::class);
