<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SSOBrokerController;


Route::get('backend/login', [SSOBrokerController::class, 'authenticateToSSO']);
Route::get('authenticateToSSO', [SSOBrokerController::class, 'authenticateToSSO']);
Route::get('authData/{authData}', [SSOBrokerController::class, 'authenticateToSSO']);
Route::get('logout/{sessionId}', [SSOBrokerController::class, 'logout']);
Route::get('logout', [SSOBrokerController::class, 'logout']);
Route::get('changeRole/{role}', [SSOBrokerController::class, 'changeRole'])->name('changeRole');





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['SSOBrokerMiddleware']], function () {
    Route::get('test', function(){
       return 'test';
    });
 });



//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function($request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});



 Route::get('/', function () {
        
    return view('welcome');
});
 


Route::get('/',[BlogController::class,'index']);
Route::get('/create',[BlogController::class,'create']);
Route::post('/store',[BlogController::class,'store']);
Route::get('/edit/{id}',[BlogController::class,'edit']);
Route::post('/update/{id}',[BlogController::class,'update']);
Route::get('/destroy/{id}',[BlogController::class,'destroy']);