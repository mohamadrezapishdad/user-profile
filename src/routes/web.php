<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;
use Larafa\UserProfile\Http\Controllers\UserWebserviceController;

Route::middleware('web')->group(function(){
    Route::get('/profiles/edit' , 'Larafa\UserProfile\Http\ProfileController@doEdit');
    Route::resource('/profiles', 'Larafa\UserProfile\Http\ProfileController');
    Route::resource('/users', 'UserController');

    Route::get('/services/follow/{user}', UserWebserviceController::class.'@addFollowing');
	Route::get('/services/hasfollowing/{user}', UserWebserviceController::class.'@hasFollowing');
	Route::get('/services/unfollow/{user}', UserWebserviceController::class.'@unfollow');
	Route::get('/services/getusers/{option}', UserWebserviceController::class.'@getUsers');

});

