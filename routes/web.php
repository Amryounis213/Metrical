<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CommunitiesController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactWithAdminController;
use App\Http\Controllers\Admin\enquiryController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RentController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\servicesController;
use App\Http\Controllers\Admin\StopOffers;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\EliteController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\SocialController;
use App\Mail\SendPassword;
use App\Models\Community;
use App\Models\ContactWithAdmin;
use App\Models\Enquiry;
use App\Models\Event;
use App\Models\News;
use App\Models\Offer;
use App\Models\Owner;
use App\Models\Property;
use App\Models\Rent;
use App\Models\User;
use App\Notifications\SendReminderForEventNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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

//Route::get('append', [PropertyController::class, 'append'])->name('append');


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
        $communities = Community::withCount(['event', 'news', 'properties'])->paginate(6);
        $topowner = DB::table('properties')->select('owner_id', DB::raw('COUNT(owner_id) as count'))->groupBy('owner_id')->orderBy('count', 'desc')->first();
        $top = Owner::findorfail($topowner->owner_id);
        $user1 = User::find($top->user_id);

        return view('admin.home.index', [
            'contact' => $contact,
            'enquires' => $enquires,
            'users' => User::where('type', '!=', 3)->count(),
            'communities' => $communities,
            'properties' => Property::count(),
            'offers' => Offer::where('status', '!=', 'stop')->count(),
            'rents' => Rent::with('property')->limit(8)->latest()->get(),
            'rents_active' => Rent::where('status', 'active')->count(),
            'total_price' => Rent::limit(5)->latest()->sum('price'),
            'news' => News::limit(3)->latest()->get(),
            'events' => Event::limit(3)->latest()->get(),
            'percantage' => Property::Percentage() ?? 0,
            'pending_users' => User::where('request_sent', 1)->paginate(5),
            'user1' => $user1 ?? null,
            'topowner' => $topowner->count ?? 0,
        ]);
    })->name('dashboard');


    Route::resource('admins', AdminController::class);
    Route::post('roles/store-user-role', [RolesController::class, 'storeUserRole'])->name('link-user-role.store');
    Route::get('roles/link-user-role', [RolesController::class, 'linkUserRole'])->name('link-user-role');
    Route::get('roles/results', [RolesController::class, 'result'])->name('roles.results');
    Route::resource('/roles', RolesController::class);


    Route::get('moveins/results', [servicesController::class, 'moveinResult'])->name('moveins.results');
    Route::get('moveins', [servicesController::class, 'moveIns'])->name('moveins');
    Route::get('accepted-moveins', [servicesController::class, 'acceptedMoveIns'])->name('accepted.moveins');
    Route::put('accept-movein/{id}', [servicesController::class, 'acceptMovein'])->name('accept-movein');
    Route::put('refuse-movein/{id}', [servicesController::class, 'refuseMovein'])->name('refuse-movein');
    Route::get('deliveries/results', [servicesController::class, 'deliveryResult'])->name('deliveries.results');
    Route::get('deliveries', [servicesController::class, 'deliveries'])->name('deliveries');
    Route::get('accepted-deliveries', [servicesController::class, 'acceptedDeliveries'])->name('accepted.deliveries');
    Route::get('accept-delivery/{id}', [servicesController::class, 'acceptDelivery'])->name('accept-delivery');
    Route::get('refuse-delivery/{id}', [servicesController::class, 'refuseDelivery'])->name('refuse-delivery');

    Route::post('users/filter', [UsersController::class, 'filter'])->name('users.filter');


    Route::get('work-permits', [servicesController::class, 'WorkPermits'])->name('WorkPermits');
    Route::get('accept-work-permits/{id}', [servicesController::class, 'acceptWorkPermits'])->name('accept-work');
    Route::get('refuse-work-permits/{id}', [servicesController::class, 'refuseWorkPermits'])->name('refuse-work');

    Route::get('moveouts/results', [servicesController::class, 'moveoutResult'])->name('moveouts.results');
    Route::get('moveouts', [servicesController::class, 'moveouts'])->name('moveouts');

    Route::get('accepted-moveouts', [servicesController::class, 'acceptedMoveouts'])->name('accepted.moveouts');
    Route::get('accept-moveout/{id}', [servicesController::class, 'acceptMoveout'])->name('accept-moveout');
    Route::get('refuse-moveout/{id}', [servicesController::class, 'refuseMoveout'])->name('refuse-moveout');
    Route::get('accept-movein/{id}', [servicesController::class, 'acceptMovein'])->name('accept-movein');
    Route::get('refuse-movein/{id}', [servicesController::class, 'refuseMovein'])->name('refuse-movein');
    Route::get('show-full-request/{id}/{type}', [servicesController::class, 'ShowFullRequest'])->name('ShowFullRequest');
    Route::get('communities/results', [CommunitiesController::class, 'result'])->name('communities.results');
    Route::get('communities/{id}/properties', [CommunitiesController::class, 'showPropertiesByCommunity'])->name('showPropertiesByCommunity');
    Route::resource('communities', CommunitiesController::class);

    Route::post('add-owner', [PropertyController::class, 'addOwner'])->name('properties.addOwner');
    Route::resource('properties', PropertyController::class);
    Route::get('properties/create/{id}', [PropertyController::class, 'addPropertyByCommunity'])->name('property.create.community');
    Route::get('properties/search/results', [PropertyController::class, 'result'])->name('properties.results');

    Route::resource('offers', OfferController::class);
    Route::get('offers/type/{type}', [OfferController::class, 'type'])->name('offer-type');
    Route::post('offers/filter', [OfferController::class, 'filter'])->name('offers.filter');

    Route::put('update-offer', [OfferController::class, 'OfferUpdate'])->name('update-offer');

    Route::post('properties/filter', [PropertyController::class, 'Filter'])->name('properties.filter');

    Route::get('upload-images/{propertyId}', [ImageUploadController::class, 'index'])->name('show-properties-image');
    Route::post('upload-images', [ImageUploadController::class, 'store'])->name('store-properties-image');

    Route::get('contact', [ContactController::class, 'index'])->name('contactShow');
    Route::delete('contact/{id}', [ContactController::class, 'delete'])->name('contacts.destroy');

    Route::get('enquires', [enquiryController::class, 'index'])->name('enquiresShow');
    Route::delete('enquires/{id}', [enquiryController::class, 'delete'])->name('enquires.delete');


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
    Route::get('binding-users/accept/{id}', [UsersController::class, 'acceptBinding'])->name('binding.accept');
    Route::delete('binding-users/refuse/{id}', [UsersController::class, 'refuseBinding'])->name('binding.refuse');
    Route::put('accept-offer/{id}', [OfferController::class, 'acceptOffers'])->name('offers.accept');
    Route::post('rent', [RentController::class, 'store'])->name('renting.store');

    Route::get('link-owner-property/{id}', [UsersController::class, 'addOwnerPage'])->name('props');

    Route::post('link-owner-property', [UsersController::class, 'addOwner'])->name('store');

    Route::get('success-link', [UsersController::class, 'successLink'])->name('successlink');

    Route::put('update-docs', [UsersController::class, 'updateDocs'])->name('update-docs');

    Route::get('user/filter/{type}', [UsersController::class, 'searchFiltering'])->name('serach');

    Route::get('import-csv', [PropertyController::class, 'importCsvView'])->name('viewImportProp');
    Route::post('import-prop', [PropertyController::class, 'import'])->name('importProp');

    Route::get('user/import-csv', [UsersController::class, 'importCsvView'])->name('viewImportUser');
    Route::post('user/import-prop', [UsersController::class, 'import'])->name('importUser');


    Route::put('user-details/{id}', [UsersController::class, 'UpdateUserInfo'])->name('updateuserinfo');
    Route::get('user-details/{id}', [UsersController::class, 'EditUser'])->name('edituser');

    Route::get('users/all', [UsersController::class, 'AllUser'])->nثame('AllUsers');
    //Route::get('new/users/create', [UsersController::class, 'addnewuser'])->name('create-users');
    Route::post('user/store', [UsersController::class, 'storeUser'])->name('storeuser');
    Route::get('addnewuser', [EliteController::class, 'showformadduser'])->name('addnewuserform');

    Route::get('stop-rent/{id}', [RentController::class, 'StopRent'])->name('StopRent');

    Route::resource('socials', SocialController::class);

    Route::get('contact/makeasread/{id}', [ContactWithAdminController::class, 'makeAsRead'])->name('contactmakeread');
    Route::get('enquiry/makeasread/{id}', [enquiryController::class, 'makeAsRead'])->name('Enquirymakeread');
    /**
     * Action Ajax
     */

    Route::get('GetPropertyByCommunity/{id}', [EliteController::class, 'GetPropertyByCommunity'])->name('GetPropertyByCommunity');
    Route::get('tenant/GetPropertyByCommunity/{id}', [EliteController::class, 'TenantGetPropertyByCommunity'])->name('TenantGetPropertyByCommunity');

    Route::get('getPhonecodeByCountry/{id}', [EliteController::class, 'GetPhonecodeByCountry'])->name('GetPhonecodeByCountry');


    Route::get('done/{id}', [UsersController::class, 'Done'])->name('Done');
    /**
     * Emails
     */
    Route::get('/email', function () {
        return new SendPassword();
    });
});
require __DIR__ . '/auth.php';
