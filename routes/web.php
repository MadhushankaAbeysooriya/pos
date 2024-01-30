<?php

use App\Models\master\AnnualDemand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DSDivisionController;
use App\Http\Controllers\LoginDetailController;
use App\Http\Controllers\master\ItemController;
use App\Http\Controllers\master\MenuController;
use App\Http\Controllers\AnnualDemandController;
use App\Http\Controllers\master\BrandController;
use App\Http\Controllers\SearchDetailController;
use App\Http\Controllers\UserHospitalController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\master\QuarterController;
use App\Http\Controllers\master\LocationController;
use App\Http\Controllers\master\MenuItemController;
use App\Http\Controllers\master\SupplierController;
use App\Http\Controllers\master\RationDateController;
use App\Http\Controllers\master\RationTimeController;
use App\Http\Controllers\master\RationTypeController;
use App\Http\Controllers\DemandFromLocationController;
use App\Http\Controllers\master\ApprovedUnitPriceController;
use App\Http\Controllers\master\MeasurementController;
use App\Http\Controllers\master\ReceiptTypeController;
use App\Http\Controllers\master\ItemCategoryController;
use App\Http\Controllers\master\LocationTypeController;
use App\Http\Controllers\ReceiptFromLocationController;
use App\Http\Controllers\master\RationCategoryController;
use App\Http\Controllers\master\RationSubCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class);

    Route::get('/users/inactive/{id}',[UserController::class,'inactive'])->name('users.inactive');
    // Route::get('/users/suspendusers/',[UserController::class,'suspendusers'])->name('users.suspendusers');
    Route::get('/users/activate/{id}',[UserController::class,'activate'])->name('users.activate');
    Route::get('/users/resetpass/{id}',[UserController::class,'resetpass'])->name('users.resetpass');
    Route::resource('users', UserController::class);

    Route::get('/change-password',  [ChangePasswordController::class,'index'])->name('change.index');
    Route::post('/change-password', [ChangePasswordController::class,'store'])->name('change.password');

    Route::get('/logindetails',[LoginDetailController::class,'index'])->name('logindetails.index');

    Route::prefix('master/')->group(function (){
        Route::resource('location_types',LocationTypeController::class);
        Route::resource('locations',LocationController::class);
        Route::resource('item_categories',ItemCategoryController::class);

        Route::get('/items/add_alternative_items/{id}',[ItemController::class,'addAlternativeView'])->name('items.add_alternative_view');
        Route::post('/items/save_alternative_items/{id}',[ItemController::class,'saveAlternative'])->name('items.save_alternative');
        Route::delete('/items/delete_alternative_item/{id}',[ItemController::class,'deleteAlternative'])->name('items.delete_alternative');

        Route::resource('items',ItemController::class);
        Route::resource('ration_dates',RationDateController::class);
        Route::resource('ration_types',RationTypeController::class);
        Route::resource('ration_times',RationTimeController::class);
        Route::resource('menus',MenuController::class);
        Route::resource('ration_categories',RationCategoryController::class);
        Route::resource('brands',BrandController::class);
        Route::resource('quarters',QuarterController::class);
        Route::resource('measurements',MeasurementController::class);
        Route::resource('receipt_types',ReceiptTypeController::class);
        Route::resource('suppliers',SupplierController::class);
        Route::resource('ration_sub_categories',RationSubCategoryController::class);
        Route::resource('approved_unit_price',ApprovedUnitPriceController::class);

        Route::prefix('{menu}/')->group(function () {
            Route::resource('menu_items',MenuItemController::class);
        });


    });

    Route::resource('annual_demands',AnnualDemandController::class);

    Route::resource('demand_from_locations',DemandFromLocationController::class);

    Route::prefix('{demand_from_location}/')->group(function () {
        Route::resource('receipt_from_locations',ReceiptFromLocationController::class);

        Route::get('/add_items_view',[DemandFromLocationController::class,'storedemandfromlocationview'])->name('demand_from_locations.add_items_view');
        Route::post('/add_items_store',[DemandFromLocationController::class,'storedemandfromlocation'])->name('demand_from_locations.add_items_store');
        Route::delete('/add_items_delete/{id}', [DemandFromLocationController::class, 'deletedemandfromlocationitem'])->name('demand_from_locations.add_items_delete');
    });

});

Route::get('/ajax/getDistricts',[AjaxController::class,'getDistricts'])->name('ajax.getDistricts');

Route::get('/ajax/getDSDivisions',[AjaxController::class,'getDSDivisions'])->name('ajax.getDSDivisions');


