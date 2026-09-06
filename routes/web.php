<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleDetailsController;
use App\Http\Controllers\Admin\AreaManagerController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\RequestCallController;
use App\Http\Controllers\Admin\CarOwnerController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\HomePageDynamicController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\VehicleTypeController;
use App\Http\Controllers\Admin\VehicleRateController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\UserAuthController;
use App\Http\Controllers\Frontend\ContactEnquiryController;

use Illuminate\Support\Facades\DB;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/location-fetch', [HomeController::class, 'location_fetch'])->name('location.fetch');
Route::post('/partner-register', [AuthController::class, 'partner_registration'])->name('partner.register');
Route::post('/driver-register', [AuthController::class, 'driver_registration'])->name('driver.register');
Route::post('/request-call-enquiry', [ContactEnquiryController::class, 'call_enquiry'])->name('requestCall.enquiry.store');
Route::post('/request-contact-enquiry', [ContactEnquiryController::class, 'contact_enquiry'])->name('contact.enquiry.store');

Route::post('/user-register', [UserAuthController::class, 'user_registration'])->name('user.register');
Route::post('/user-login', [UserAuthController::class, 'user_login'])->name('user.login');
 


Route::middleware('auth')->prefix('user')->name('user.')->group(function () {

    Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');


});



Route::prefix('admin')->name('admin.')->group(function () {

    // Guest Routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
        Route::post('/authenticate', [AdminAuthController::class, 'authentication'])->name('authentication');
    });

    // Protected Routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('home-dynamic', [HomePageDynamicController::class, 'index'])->name('home.dynamic');
        Route::get('home-banner-create', [HomePageDynamicController::class, 'create'])->name('home-banner.create');
        Route::post('home-banner-store', [HomePageDynamicController::class, 'banner_store'])->name('home-banner.store');
        Route::get('home-banner-edit/{id}', [HomePageDynamicController::class, 'banner_edit'])->name('home-banner.edit');
        Route::put('home-banner-update/{id}', [HomePageDynamicController::class, 'banner_update'])->name('home-banner.update');
        Route::delete('/home-banner-delete/{id}', [HomePageDynamicController::class, 'banner_delete'])->name('home-banner.delete');
        Route::post('banner-change-status', [HomePageDynamicController::class, 'banner_update_status'])->name('home-banner.update_status');

         Route::get('home-destination-create', [HomePageDynamicController::class, 'destination_create'])->name('home-destination.create');
        Route::post('home-destination-store', [HomePageDynamicController::class, 'destination_store'])->name('home-destination.store');
        Route::get('home-destination-edit/{id}', [HomePageDynamicController::class, 'destination_edit'])->name('home-destination.edit');
        Route::put('home-destination-update/{id}', [HomePageDynamicController::class, 'destination_update'])->name('home-destination.update');
        Route::delete('/home-destination-delete/{id}', [HomePageDynamicController::class, 'destination_delete'])->name('home-destination.delete');
        Route::post('destination-change-status', [HomePageDynamicController::class, 'destination_update_status'])->name('home-destination.update_status');

        Route::post('home-second-section-update', [HomePageDynamicController::class, 'second_section_update'])->name('home-second-section.update');
        Route::post('home-fourth-section-update', [HomePageDynamicController::class, 'fourth_section_update'])->name('home-fourth-section.update');

        Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
        Route::post('contact-details-update', [ContactUsController::class, 'update_details'])->name('contact-details.update');

        Route::resource('country', CountryController::class);
        Route::post('country-change-status', [CountryController::class, 'country_update_status'])->name('country.update_status');
        Route::resource('state', StateController::class);
        Route::post('state-change-status', [StateController::class, 'state_update_status'])->name('state.update_status');
        Route::resource('district', DistrictController::class);
        Route::post('district-change-status', [DistrictController::class, 'district_update_status'])->name('district.update_status');

        Route::resource('city', CityController::class);
        Route::post('city-change-status', [CityController::class, 'city_update_status'])->name('city.update_status');

        Route::post('fetch-state', [CityController::class, 'all_state_fetch'])->name('fetch_state');
        Route::post('fetch-district', [CityController::class, 'district_fetch_accState'])->name('fetch_district');
        Route::post('fetch-city', [CityController::class, 'city_fetch_accDist'])->name('fetch_city');
        Route::post('fetch-area', [CityController::class, 'area_fetch_accCity'])->name('fetch_area');
        Route::post('fetch-area-manager', [CityController::class, 'areaManager_fetch_accArea'])->name('fetch_area_manager');

        Route::resource('area', AreaController::class);
        Route::post('area-change-status', [AreaController::class, 'area_update_status'])->name('area.update_status');


        Route::resource('vehicle-details', VehicleDetailsController::class);
        Route::get('/vehicle-details/{id}/view', [VehicleDetailsController::class, 'show'])->name('vehicleDetails.show');
        Route::post('vehicle-details-change-status', [VehicleDetailsController::class, 'vehicleDetails_update_status'])->name('vehicleDetails.update_status');
    
        Route::resource('area-manager', AreaManagerController::class);
        Route::post('area-manager-change-status', [AreaManagerController::class, 'areaManager_update_status'])->name('areaManager.update_status');
        Route::get('/area-manager-details/{id}/view', [AreaManagerController::class, 'show'])->name('areaManagerDetails.show');


        Route::resource('car-owner', CarOwnerController::class);
        Route::post('car-owner-change-status', [CarOwnerController::class, 'carOwner_update_status'])->name('carOwner.update_status');
        Route::get('/car-owner-details/{id}/view', [CarOwnerController::class, 'show'])->name('carOwnerDetails.show');


        Route::resource('driver', DriverController::class);
        Route::post('driver-change-status', [DriverController::class, 'driver_update_status'])->name('driver.update_status');
        Route::get('/driver-details/{id}/view', [DriverController::class, 'show'])->name('driverDetails.show');


        Route::resource('vehicle-types', VehicleTypeController::class);
        Route::post('vehicle-types-change-status', [VehicleTypeController::class, 'vehicleTypes_update_status'])->name('vehicle-types.update_status');

        Route::resource('vehicle-rates', VehicleRateController::class);
        Route::post('vehicle-rate-status-change', [VehicleRateController::class, 'vehicleRates_update_status'])->name('vehicle-rates.update_status');


        Route::get('/request-call-enquiry-list', [RequestCallController::class, 'requestCall_index'])->name('requestCall.index');
        Route::post('request-call-change-status', [RequestCallController::class, 'requestCall_update_status'])->name('requestCall.update_status');
        Route::delete('/request-call-enquiry-delete/{id}', [RequestCallController::class, 'requestCall_destroy'])->name('requestCall.delete');
        Route::get('/request-call-details/{id}/view', [RequestCallController::class, 'view'])->name('request-call.view');
        Route::get('/request-call-enquiry-edit/{id}', [RequestCallController::class, 'requestCall_edit'])->name('requestCall.edit');
        Route::put('/request-call-enquiry-update/{id}', [RequestCallController::class, 'requestCall_update'])->name('requestCall.update');

    });

});

