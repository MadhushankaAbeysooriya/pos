<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginDetailController;
use App\Http\Controllers\master\ItemController;
use App\Http\Controllers\master\BrandController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\master\LocationController;
use App\Http\Controllers\master\SupplierController;
use App\Http\Controllers\master\MeasurementController;
use App\Http\Controllers\master\ItemCategoryController;
use App\Http\Controllers\master\LocationTypeController;

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

        Route::resource('items',ItemController::class);
        Route::resource('brands',BrandController::class);
        Route::resource('measurements',MeasurementController::class);
        Route::resource('suppliers',SupplierController::class);

    });

});
