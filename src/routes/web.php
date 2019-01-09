<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;
use Larafa\UserProfile\Http\Controllers\UserServiceController;

Route::middleware('web')->group(function(){
    Route::get('/profiles/edit' , 'Larafa\UserProfile\Http\ProfileController@doEdit');
    Route::resource('/profiles', 'Larafa\UserProfile\Http\ProfileController');

    Route::get('/services/follow/{user}', UserServiceController::class.'@addFollowing');
	Route::get('/services/hasfollowing/{user}', UserServiceController::class.'@hasFollowing');
	Route::get('/services/unfollow/{user}', UserServiceController::class.'@unfollow');
	Route::get('/services/getusers/{option}', UserServiceController::class.'@getUsers');

});

