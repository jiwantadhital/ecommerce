<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\ProvinceController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\MunicipalityController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Frontend\HomeController;

//dd(\Illuminate\Support\Facades\Hash::make('TEN@#!123'));
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


//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/lang/{language}',[\App\Http\Controllers\LocalizationController::class,'index'])->name('set_localization');


Auth::routes([
    'register' => true,
]);

Route::prefix('/customer')->name('customer.')->namespace('Customer')->group(function(){

    Route::get('/dashboard',[\App\Http\Controllers\Customer\HomeController::class,'index'])->name('home');
    Route::namespace('Auth')->group(function(){

        //Login Routes
        Route::get('/login',[App\Http\Controllers\Customer\Auth\LoginController::class,'showLoginForm'])->name('login');
        Route::post('/login',[App\Http\Controllers\Customer\Auth\LoginController::class,'login']);
        Route::post('/logout',[\App\Http\Controllers\Customer\Auth\LoginController::class,'logout'])->name('logout');

        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');

    });
});

Route::get('cancel', [HomeController::class,'cancel'])->name('payment.cancel');
Route::get('payment/success', [HomeController::class,'success'])->name('payment.success');
Route::post('cart/order', [HomeController::class, 'order'])->name('frontend.order');

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/subcategory/{slug}', [HomeController::class, 'subcategory'])->name('frontend.subcategory');

Route::get('/product/{slug}', [HomeController::class, 'product'])->name('frontend.product');

Route::post('/product/cart', [HomeController::class, 'addToCart'])->name('frontend.cart.add');
Route::get('cart', [HomeController::class, 'listCart'])->name('frontend.cart');
Route::get('/cart/checkout', [HomeController::class, 'checkout'])->name('frontend.cart.checkout');

Route::get('/customer/register', [HomeController::class, 'registerCustomer'])->name('frontend.customer.register');
//Route::get('/customer/login', [HomeController::class, 'loginCustomer'])->name('frontend.customer.login');
Route::post('/customer/register', [HomeController::class, 'storeCustomer'])->name('frontend.customer.store');
Route::get('/customer/verify_email/{code}', [HomeController::class, 'verifyEmail'])->name('frontend.customer.verify_email');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('backend/')->middleware(['role_permission'])->name('backend.')->group(function(){

    Route::get('/backend/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//    Route::get('/profile/show', [DashboardController::class, 'show'])->name('profile.show');
//    Route::get('/settings/show', [DashboardController::class, 'show'])->name('settings.show');

    Route::get('unit/trash', [UnitController::class, 'trash'])->name('unit.trash');
    Route::post('unit/{id}/restore', [UnitController::class, 'restore'])->name('unit.restore');
    Route::delete('unit/{id}/force-delete', [UnitController::class, 'forceDelete'])->name('unit.forceDelete');
    Route::resource('unit',UnitController::class);

    Route::get('province/trash', [ProvinceController::class,'trash'])->name('province.trash');
    Route::post('province/{id}/restore', [ProvinceController::class,'restore'])->name('province.restore');
    Route::delete('province/{id}/force-delete',[ProvinceController::class,'forceDelete'])->name('province.forceDelete');
    //for ajax to get district by province id
    Route::post('province/getDistrictByProvinceId',[ProvinceController::class,'getDistrictByProvinceId'])->name('province.getDistrict');
    Route::resource('province',ProvinceController::class);

    Route::get('district/trash', [DistrictController::class,'trash'])->name('district.trash');
    Route::post('district/{id}/restore', [DistrictController::class,'restore'])->name('district.restore');
    Route::delete('district/{id}/force-delete',[DistrictController::class,'forceDelete'])->name('district.forceDelete');
    Route::resource('district',DistrictController::class);

    Route::get('municipality/trash', [MunicipalityController::class,'trash'])->name('municipality.trash');
    Route::post('municipality/{id}/restore', [MunicipalityController::class,'restore'])->name('municipality.restore');
    Route::delete('municipality/{id}/force-delete',[MunicipalityController::class,'forceDelete'])->name('municipality.forceDelete');
    Route::resource('municipality',MunicipalityController::class);


    //for ajax to get subcategory by category id
    Route::post('category/getSubcategoryByCategoryId',[CategoryController::class,'getSubcategoryByCategoryId'])->name('category.getSubcategory');
    Route::get('category/trash', [CategoryController::class,'trash'])->name('category.trash');
    Route::post('category/{id}/restore', [CategoryController::class,'restore'])->name('category.restore');
    Route::delete('category/{id}/force-delete',[CategoryController::class,'forceDelete'])->name('category.forceDelete');
    Route::resource('category',CategoryController::class);


    Route::post('product/getAllAttribute',[ProductController::class,'getAllAttribute'])->name('product.getAllAttribute');
    Route::post('product/changeStatusById',[ProductController::class,'changeStatusById'])->name('product.changeStatus');

    Route::get('product/trash', [ProductController::class,'trash'])->name('product.trash');
    Route::post('product/{id}/restore', [ProductController::class,'restore'])->name('product.restore');
    Route::delete('product/{id}/force-delete',[ProductController::class,'forceDelete'])->name('product.forceDelete');
    Route::resource('product',ProductController::class);

    Route::get('attribute/trash', [AttributeController::class,'trash'])->name('attribute.trash');
    Route::post('attribute/{id}/restore', [AttributeController::class,'restore'])->name('attribute.restore');
    Route::delete('attribute/{id}/force-delete',[AttributeController::class,'forceDelete'])->name('attribute.forceDelete');
    Route::resource('attribute',AttributeController::class);

    Route::get('subcategory/trash', [SubcategoryController::class,'trash'])->name('subcategory.trash');
    Route::post('subcategory/{id}/restore', [SubcategoryController::class,'restore'])->name('subcategory.restore');
    Route::delete('subcategory/{id}/force-delete',[SubcategoryController::class,'forceDelete'])->name('subcategory.forceDelete');
    Route::resource('subcategory',SubcategoryController::class);

    //Role
    Route::get('role/assign_permission/{role_id}', [RoleController::class,'assignPermission'])->name('role.assign_permission');
    Route::post('role/assign_permission', [RoleController::class,'postPermission'])->name('role.post_permission');

    Route::get('role/trash', [RoleController::class,'trash'])->name('role.trash');
    Route::post('role/{id}/restore', [RoleController::class,'restore'])->name('role.restore');
    Route::delete('role/{id}/force-delete',[RoleController::class,'forceDelete'])->name('role.forceDelete');
    Route::resource('role',RoleController::class);

    //Module
    Route::get('module/trash', [ModuleController::class,'trash'])->name('module.trash');
    Route::post('module/{id}/restore', [ModuleController::class,'restore'])->name('module.restore');
    Route::delete('module/{id}/force-delete',[ModuleController::class,'forceDelete'])->name('module.forceDelete');
    Route::resource('module',ModuleController::class);

    //Permission
    Route::get('permission/trash', [PermissionController::class,'trash'])->name('permission.trash');
    Route::post('permission/{id}/restore', [PermissionController::class,'restore'])->name('permission.restore');
    Route::delete('permission/{id}/force-delete',[PermissionController::class,'forceDelete'])->name('permission.forceDelete');
    Route::resource('permission',PermissionController::class);
});

