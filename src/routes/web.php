<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::middleware('web')->group(function(){
	Route::resource('/profiles', 'Larafa\UserProfile\Http\ProfileController');
});

