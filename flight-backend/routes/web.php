<?php


use App\Http\Controllers\UserController as APIUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/greeting', function () {
    return 'Hello World';
});


Route::get('/', function () {
    return view('welcome');
});
