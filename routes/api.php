<?php
use App\Http\Controllers\ga4api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(ga4api::class)->group(function () {
    //  Route::get('/ga4apis/{id}', 'show');
    Route::get('/ga4apis/{id}/{startdate?}/{endingdate?}/{countryId?}', 'show');
    // Route::get('/orders/{id}', 'show');
    // Route::post('/orders', 'store');
});