<?php

use App\Http\Controllers\Admin\ContactWithAdminController;
use App\Http\Controllers\API\AccessTokenController;
use App\Http\Controllers\API\AmenityController;
use App\Http\Controllers\API\CommunityController;
use App\Http\Controllers\API\CountriesController;
use App\Http\Controllers\API\EnquiryController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\API\RentController;
use App\Http\Controllers\API\servicesController;
use App\Http\Controllers\API\StopOfferController;
use App\Http\Controllers\API\UserController;
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


Route::middleware(['localization', 'auth:sanctum'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('new-user-with-news', [UserController::class, 'withNews']);
    Route::apiResource('communities', CommunityController::class);
    Route::apiResource('properties', PropertyController::class);
    Route::get('properties/status/{status}', [PropertyController::class, 'Status']);
    Route::get('properties/type/{offer_type}', [PropertyController::class, 'type']);
    Route::get('properties/shortterm/{short}', [PropertyController::class, 'shortTerm']);




    Route::apiResource('rents', RentController::class);
    Route::apiResource('amenities', AmenityController::class);
    Route::apiResource('news', NewsController::class);
    Route::get('community/{id}/news', [NewsController::class, 'newsByCommunity']);
    Route::apiResource('events', EventController::class);
    Route::get('community/{id}/events', [EventController::class, 'eventsByCommunity']);
    Route::get('community/{id}/status/{status}', [CommunityController::class, 'Status']);

    Route::apiResource('enquiry', EnquiryController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('offers', OfferController::class);
    Route::post('stop-offer', [StopOfferController::class, 'store']);
    //Route::put('accept-offer', [OfferController::class , 'acceptOffers']);


    Route::prefix('services')->group(function () {
        Route::post('movein', [servicesController::class, 'moveIn']);
        Route::post('moveout', [servicesController::class, 'moveOut']);
        Route::post('work-permit', [servicesController::class, 'workPermit']);
        Route::post('delivery-permit', [servicesController::class, 'deliveryPermit']);
    });


    Route::get('home', [UserController::class, 'home']);

    //new requests Mohammed Profile
    Route::get('profile/movein', [ProfileController::class, 'moveIn'])
        ->middleware('auth:sanctum');
    Route::get('profile/moveout', [ProfileController::class, 'moveOut'])
        ->middleware('auth:sanctum');
    Route::get('profile/work-permit', [ProfileController::class, 'WorkPermit'])
        ->middleware('auth:sanctum');
    Route::get('profile/delivery-permit', [ProfileController::class, 'Delivery'])
        ->middleware('auth:sanctum');
});
//API (Amr Younis)

Route::get('countries', [CountriesController::class, 'showallcountries']);
Route::get('countries/{id}/cities', [CountriesController::class, 'showCitiesByCountry']);
Route::get('settings', [CountriesController::class, 'termswithcountries']);

//Auth Request (Mohammed Obaid)
Route::post('auth/signUp', [AccessTokenController::class, 'signUp']);
Route::post('auth/code/send', [AccessTokenController::class, 'sendCode']);
Route::post('auth/code/check', [AccessTokenController::class, 'checkCode']);

Route::post('auth/password/before-update', [AccessTokenController::class, 'beforeUpdate']);
Route::post('auth/password/update', [AccessTokenController::class, 'updatePassword']);
Route::post('auth/tokens', [AccessTokenController::class, 'store']);
Route::delete('auth/tokens', [AccessTokenController::class, 'destroy'])
    ->middleware('auth:sanctum');

Route::post('auth/request/tenant', [AccessTokenController::class, 'requestAsTenant'])
    ->middleware('auth:sanctum');

Route::post('auth/request/owner', [AccessTokenController::class, 'requestAsOwner'])
    ->middleware('auth:sanctum');

Route::get('term', [AccessTokenController::class, 'terms']);
Route::post('changePass', [AccessTokenController::class, 'changePass'])
    ->middleware('auth:sanctum');

Route::post('interested', [EventController::class, 'interested'])
    ->middleware('auth:sanctum');



Route::post('contact', [ContactWithAdminController::class, 'store'])
    ->middleware('auth:sanctum');
// for personal information
Route::put('profile/person_info', [UserController::class, 'editPersonalProfile'])
    ->middleware('auth:sanctum');

Route::get('profile/person_info', [UserController::class, 'showPersonalProfile'])
    ->middleware('auth:sanctum');

// for Family info
Route::put('profile/family_info', [UserController::class, 'editProfile'])
    ->middleware('auth:sanctum');

Route::get('profile/family_info', [UserController::class, 'showProfile'])
    ->middleware('auth:sanctum');





