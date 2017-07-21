<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Authentication routes API */
Route::middleware('auth:api')->group(function () {

    /* Secure Data */
    Route::get('/user', function(){
        return response()->json(['message' => 'Authenticated Successfully.'], 200);
    });
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@authenticate');
Route::post('/login/refresh', 'AuthController@refreshToken');

/* Testing Route */
Route::get('/guest', function(){
    return response()->json(['message' => 'Guest Request.'], 200);
});

/* Role & Permission Attach */
Route::get('/user/{user_id}/roles', 'HomeController@getUserRole');
Route::get('/user/{user_id}/roles/{role_name}', 'HomeController@attachUserRole');
Route::post('/role/permission', 'HomeController@attachPermission');
Route::get('/user_permission/{user_id}/{permission}', 'HomeController@checkPermission');