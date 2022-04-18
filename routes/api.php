<?php
use App\Models\User;
use App\Http\Controllers;
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

Route::post('login','App\Http\Controllers\UserController@login');
Route::post('createorupdateuser','App\Http\Controllers\UserController@createOrUpdateUser');
Route::get('getuserdetails/{role_type}','App\Http\Controllers\UserController@getUserDetails');
Route::post('contactus','App\Http\Controllers\QueriesController@contactus');
Route::post('createorupdatebusiness','App\Http\Controllers\BusinessController@insertOrUpdateBusiness');
Route::get('getbusinessdetails','App\Http\Controllers\BusinessController@getBusinessDetails');
Route::post('createormodifyevent','App\Http\Controllers\EventController@insertOrUpdateEvent');
Route::get('getevents','App\Http\Controllers\EventController@getEvents');
Route::post('createormodifyflight','App\Http\Controllers\FlightController@insertOrUpdateFlight');
Route::get('getflights','App\Http\Controllers\FlightController@getFlightDetails');
Route::post('createormodifyclinic','App\Http\Controllers\ClinicController@insertOrUpdateClinic');
Route::get('getclinics','App\Http\Controllers\ClinicController@getClinics');
Route::post('createormodifydiscount','App\Http\Controllers\DiscountController@insertOrUpdateDiscount');
Route::get('getdiscounts','App\Http\Controllers\DiscountController@getDiscounts');
Route::post('registertoschool','App\Http\Controllers\SchoolController@registerToSchool');
Route::get('getschools','App\Http\Controllers\SchoolController@getSchools');
Route::get('getschoolregistrationbyid/{user_id}','App\Http\Controllers\SchoolController@getSchoolRegistrationById');
//Route::get("login","Login@login");