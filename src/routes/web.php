<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function(){
    Route::get('/profiles/edit' , 'Larafa\UserProfile\Http\ProfileController@doEdit');
    Route::resource('/profiles', 'Larafa\UserProfile\Http\ProfileController');

});

