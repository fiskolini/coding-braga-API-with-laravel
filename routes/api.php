<?php

use Illuminate\Http\Request;

// Main version (v1) routes
Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {

    // events
    Route::resource('events', 'EventsController', [
        'except' => ['edit', 'create'] // dirty dust
    ]);

    // Not found fallback
    Route::fallback(function(){
        return response()->json(['message' => 'Not Found.'], 404);
    })->name('api.404');

    // get logged in user information
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
