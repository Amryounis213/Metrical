<?php

use App\Http\Controllers\Admin\CommunitiesController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactWithAdminController;
use App\Http\Controllers\Admin\enquiryController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\admin\RentController;
use App\Http\Controllers\API\CommunityController;
use App\Models\Rent;
use App\Models\Stopoffer;
use App\Models\Tenant;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\servicesController;
use App\Http\Controllers\Admin\StopOffers;
use App\Http\Controllers\EventsController;
use App\Models\Community;
use App\Models\ContactWithAdmin;
use App\Models\Enquiry;
use App\Models\News;
use App\Models\Offer;
use App\Models\Property;

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
Route::get('append', [PropertyController::class , 'append'])->name('append');


Route::get('admin-panel', function () {
    return view('admin.home.index');
});






Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('admin-panel', function () {
        $contact = ContactWithAdmin::count();
        $enquires = Enquiry::count();
        return view('admin.home.index', [
            'contact' => $contact,
            'enquires' => $enquires,
            'users' => User::where('type', '!=', 3)->count(),
            'communities' => Community::count(),
            'properties' => Property::count(),
            'offers' => Offer::where('status', '!=', 'stop')->count(),
            'pending_users' => User::where('status', '0')->where('type', '<>', '0')->count(),
            'rents' => Rent::with('property')->limit(5)->latest()->get(),
            'total_price' => Rent::limit(5)->latest()->sum('price'),
            'events' => News::limit(3)->latest()->get(),
        ]);
    })->name('dashboard');
    Route::post('roles/store-user-role', [RolesController::class, 'storeUserRole'])->name('link-user-role.store');
    Route::get('roles/link-user-role', [RolesController::class, 'linkUserRole'])->name('link-user-role');
    Route::get('roles/results', [RolesController::class, 'result'])->name('roles.results');
    Route::resource('/roles', RolesController::class);

    Route::get('moveins', [servicesController::class, 'moveIns'])->name('moveins');
    Route::put('accept-movein/{id}', [servicesController::class, 'acceptMovein'])->name('accept-movein');
    Route::put('refuse-movein/{id}', [servicesController::class, 'refuseMovein'])->name('refuse-movein');

    Route::get('communities/results', [CommunitiesController::class, 'result'])->name('communities.results');
    Route::resource('communities', CommunitiesController::class);

    Route::post('add-owner', [PropertyController::class, 'addOwner'])->name('properties.addOwner');
    Route::resource('properties', PropertyController::class);
    Route::resource('offers', OfferController::class);
    Route::get('offers/type/{type}', [OfferController::class, 'type'])->name('offer-type');


    Route::get('contact', [ContactController::class, 'index'])->name('contactShow');
    Route::get('enquires', [enquiryController::class, 'index'])->name('enquiresShow');

    Route::get('stop-offer', [StopOffers::class, 'index'])->name('offers.stop');

    Route::get('events/results', [EventsController::class, 'result'])->name('events.results');
    Route::resource('events', EventsController::class);

    Route::get('news/results', [NewsController::class, 'result'])->name('news.results');
    Route::resource('news', NewsController::class);

    Route::get('contacts/results', [ContactWithAdminController::class, 'result'])->name('contacts.results');

    Route::get('enquires/results', [enquiryController::class, 'result'])->name('enquires.results');

    Route::get('binding-users', [UsersController::class, 'index'])->name('binding.users');
    Route::get('tenants-users', [UsersController::class, 'tenants'])->name('tenants.users');
    Route::get('owners-users', [UsersController::class, 'owners'])->name('owners.users');
    Route::get('binding-users/{id}', [UsersController::class, 'showBindingUser'])->name('binding.show');
    Route::put('binding-users/accept/{id}', [UsersController::class, 'acceptBinding'])->name('binding.accept');
    Route::put('binding-users/refuse/{id}', [UsersController::class, 'refuseBinding'])->name('binding.refuse');
    Route::put('accept-offer/{id}', [OfferController::class, 'acceptOffers'])->name('offers.accept');
    Route::post('rent', [RentController::class, 'store'])->name('renting.store');
    Route::post('import-prop', [PropertyController::class , 'import'])->name('importProp');
});
require __DIR__ . '/auth.php';
