<?php

use Illuminate\Http\Request;

// Main version (v1) routes
Route::prefix('v1')->group(function () {

    // Authenticable routes
    Route::group(['middleware' => 'auth:api'], function () {
        // events
        Route::resource('events', 'EventsController', [
            'except' => ['edit', 'create'] // dirty dust
        ]);

        // get logged in user information
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

    });

    // Not found fallback
    Route::fallback(function () {
        return response()->json(['message' => 'Not Found.'], 404);
    })->name('api.404');
});
