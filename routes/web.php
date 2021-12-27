<?php

use App\Http\Controllers\Admin\CommunitiesController;
use App\Http\Controllers\Admin\ContactController;
<<<<<<< HEAD
=======
use App\Http\Controllers\Admin\ContactWithAdminController;
>>>>>>> 93a1258a4c00bc0e581989f9b684acf4415b6e76
use App\Http\Controllers\Admin\enquiryController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\admin\RentController;
<<<<<<< HEAD
=======
use App\Http\Controllers\Admin\RolesController;
>>>>>>> 93a1258a4c00bc0e581989f9b684acf4415b6e76
use App\Http\Controllers\Admin\servicesController;
use App\Http\Controllers\admin\StopOffers;
use App\Http\Controllers\API\CommunityController;
use App\Http\Controllers\EventsController;
use App\Models\Rent;
use App\Models\Stopoffer;
use App\Models\Tenant;
use App\Models\User;
use App\Notifications\SendReminderForEventNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
<<<<<<< HEAD
    $events =  Rent::with('tenet')->whereDate('to', Carbon::now()->addDays(7))->get();
    // return $events[0]->tenet;x
    foreach ($events as $event) {
        // return $event->property->name_en;
        // $user =  $event->tenet;
        // // return $event[0];
        // $user->notify(new SendReminderForEventNotification($eventx));
        // foreach($event->tenet as $user){
        //     // $user = User::find($user);
        //     return $user;
        //     // return $user;
        // //    return $event->property->name_en;
=======
    $events = Rent::with('tenet')->whereDate('to', Carbon::now()->addDays(7))->get();
    // return $events[0]->tenet;x
    foreach ($events as $event) {
        // return $event->property->name_en;
        // $user = $event->tenet;
        // // return $event[0];
        // $user->notify(new SendReminderForEventNotification($eventx));
        // foreach($event->tenet as $user){
        // // $user = User::find($user);
        // return $user;
        // // return $user;
        // // return $event->property->name_en;
>>>>>>> 93a1258a4c00bc0e581989f9b684acf4415b6e76
        // }

    }
    return view('welcome');
});

Route::get('admin-panel', function () {
    return view('admin.home.index');
});



<<<<<<< HEAD
Route::prefix('admin')->middleware('auth')->group(function () {
=======
Route::prefix('admin')->group(function () {

    Route::post('roles/store-user-role', [RolesController::class, 'storeUserRole'])->name('link-user-role.store');
    Route::get('roles/link-user-role', [RolesController::class, 'linkUserRole'])->name('link-user-role');
    Route::get('roles/results', [RolesController::class, 'result'])->name('roles.results');
    Route::resource('/roles', RolesController::class);
>>>>>>> 93a1258a4c00bc0e581989f9b684acf4415b6e76

    Route::get('moveins', [servicesController::class, 'moveIns'])->name('moveins');
    Route::put('accept-movein/{id}', [servicesController::class, 'acceptMovein'])->name('accept-movein');
    Route::put('refuse-movein/{id}', [servicesController::class, 'refuseMovein'])->name('refuse-movein');

    Route::get('communities/results', [CommunitiesController::class, 'result'])->name('communities.results');
    Route::resource('communities', CommunitiesController::class);

    Route::post('add-owner', [PropertyController::class, 'addOwner'])->name('properties.addOwner');
    Route::resource('properties', PropertyController::class);
    Route::resource('offers', OfferController::class);
    Route::get('offers/type/{type}', [OfferController::class, 'type'])->name('offer-type');
<<<<<<< HEAD
    Route::resource('events', EventsController::class);
    Route::resource('news', NewsController::class);


    Route::get('contact', [ContactController::class, 'index'])->name('contactShow');
    Route::get('enquires', [enquiryController::class, 'index'])->name('enquiresShow');

    Route::get('stop-offer', [StopOffers::class, 'index'])->name('offers.stop');
=======

    Route::get('events/results', [EventsController::class, 'result'])->name('events.results');
    Route::resource('events', EventsController::class);

    Route::get('news/results', [NewsController::class, 'result'])->name('news.results');
    Route::resource('news', NewsController::class);

    Route::get('contacts/results', [ContactWithAdminController::class, 'result'])->name('contacts.results');
    Route::get('contact', [ContactController::class, 'index']);

    Route::get('enquires/results', [enquiryController::class, 'result'])->name('enquires.results');
    Route::get('enquires', [enquiryController::class, 'index']);

    Route::get('stop-offer', [StopOffers::class, 'index'])->name('offers.index');
>>>>>>> 93a1258a4c00bc0e581989f9b684acf4415b6e76
    Route::get('binding-users', [UsersController::class, 'index'])->name('binding.users');
    Route::get('tenants-users', [UsersController::class, 'tenants'])->name('tenants.users');
    Route::get('owners-users', [UsersController::class, 'owners'])->name('owners.users');
    Route::get('binding-users/{id}', [UsersController::class, 'showBindingUser'])->name('binding.show');
    Route::put('binding-users/accept/{id}', [UsersController::class, 'acceptBinding'])->name('binding.accept');
    Route::put('binding-users/refuse/{id}', [UsersController::class, 'refuseBinding'])->name('binding.refuse');
    Route::put('accept-offer/{id}', [OfferController::class, 'acceptOffers'])->name('offers.accept');
    Route::post('rent', [RentController::class, 'store'])->name('renting.store');
});
<<<<<<< HEAD
=======
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

>>>>>>> 93a1258a4c00bc0e581989f9b684acf4415b6e76
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
