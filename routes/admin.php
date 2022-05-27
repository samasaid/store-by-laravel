<?php

use App\Http\Controllers\Admin\AttributesController;
use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\OptionsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TagsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group([
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){

// route for admin authentecation ***********************this admin is a guard name of admin
Route::group(['namespace'=>'Admin' , "middleware"=>'auth:admin' , 'prefix'=>'admin'] , function(){
    // هنا الحاجات اللى هتتنفذ والادمن مسجل دخول
    //dashboard route
  Route::get("Dashboard" , [DashboardController::class , "index"])->name('admin.dashboard'); //اول صفحة هيزورها الادمن لو هو مسجل دخول
  //logout route
  Route::get('logout' , [LoginController::class , 'logout'])->name('admin.logout');
  ######################### Settings routes ###############################
  Route::group(['prefix'=>'settings'] , function(){
    Route::get('shipping-method/{type}' , [SettingsController::class , 'edit_shipping'])->name('edit-shipping-method');
    Route::put('edit-shipping-method/{id}' , [SettingsController::class , 'update_shipping'])->name('update-shipping-method');

  });
   ######################### end Settings routes ###############################

    ######################### Profile routes ###############################
  Route::group(['prefix'=>'profile'] , function(){
    Route::get('edit' , [ProfileController::class , 'edit_profile'])->name('edit.profile');
    Route::put('update' , [ProfileController::class , 'update_profile'])->name('update.profile');

  });
   ######################### end Profile routes ###############################

    ######################### Main Categories routes ###############################
    Route::prefix('maincategories')->group(function () {
        Route::get("/" , [ MainCategoryController::class , "index"] )->name('admin.mainCategories');
        Route::get("create" , [ MainCategoryController::class , "create"] )->name('admin.mainCategories.create');
        Route::post("add" , [ MainCategoryController::class , "store"] )->name('admin.mainCategories.store');
        Route::get("delete/{id}" , [MainCategoryController::class , "destroy"])->name('admin.mainCategories.delete');
        Route::get("edit/{id}" , [MainCategoryController::class , "edit"])->name('admin.mainCategories.edit');
        Route::get("update/{id}" , [MainCategoryController::class , "update"])->name('admin.mainCategories.update');
        Route::get("changeStatus/{id}" , [MainCategoryController::class , "ChangeStatus"])->name('admin.mainCategories.change');
    });
    ######################### end Main Categories routes ###############################

     ######################### Sub Categories routes ###############################
     Route::prefix('subcategories')->group(function () {
        Route::get("/" , [ SubCategoryController::class , "index"] )->name('admin.subCategories');
        Route::get("create" , [ SubCategoryController::class , "create"] )->name('admin.subCategories.create');
        Route::post("add" , [ SubCategoryController::class , "store"] )->name('admin.subCategories.store');
        Route::get("delete/{id}" , [SubCategoryController::class , "destroy"])->name('admin.subCategories.delete');
        Route::get("edit/{id}" , [SubCategoryController::class , "edit"])->name('admin.subCategories.edit');
        Route::get("update/{id}" , [SubCategoryController::class , "update"])->name('admin.subCategories.update');
        Route::get("changeStatus/{id}" , [SubCategoryController::class , "ChangeStatus"])->name('admin.subCategories.change');
    });
    ######################### end Sub Categories routes ###############################

     ######################### Brands routes ###############################
     Route::prefix('brands')->group(function () {
        Route::get("/" , [ BrandController::class , "index"] )->name('admin.brands');
        Route::get("create" , [ BrandController::class , "create"] )->name('admin.brands.create');
        Route::post("add" , [ BrandController::class , "store"] )->name('admin.brands.store');
        Route::get("delete/{id}" , [BrandController::class , "destroy"])->name('admin.brands.delete');
        Route::get("edit/{id}" , [BrandController::class , "edit"])->name('admin.brands.edit');
        Route::get("update/{id}" , [BrandController::class , "update"])->name('admin.brands.update');
        Route::get("changeStatus/{id}" , [BrandController::class , "ChangeStatus"])->name('admin.brands.change');
    });
    ######################### end Brands routes ###############################
    ######################### tags routes ###############################
    Route::prefix('tags')->group(function () {
    Route::get("/" , [ TagsController::class , "index"] )->name('admin.tags');
    Route::get("create" , [ TagsController::class , "create"] )->name('admin.tags.create');
    Route::post("add" , [ TagsController::class , "store"] )->name('admin.tags.store');
    Route::get("delete/{id}" , [TagsController::class , "destroy"])->name('admin.tags.delete');
    Route::get("edit/{id}" , [TagsController::class , "edit"])->name('admin.tags.edit');
    Route::get("update/{id}" , [TagsController::class , "update"])->name('admin.tags.update');
});
######################### end tags routes ###############################
    ######################### tags routes ###############################
    Route::prefix('products')->group(function () {
    Route::get("/" , [ ProductsController::class , "index"] )->name('admin.products');
    Route::get("create-generalInfo" , [ ProductsController::class , "create"] )->name('admin.products.general.create');
    Route::post("add-generalInfo" , [ ProductsController::class , "store"] )->name('admin.products.general.store');
    // update price
    Route::get("price/{id}" , [ ProductsController::class , "getPrice"] )->name('admin.products.price');
    Route::post("add-price" , [ ProductsController::class , "addPrice"] )->name('admin.products.price.store');
    //update stock
    Route::get("stock/{id}" , [ ProductsController::class , "getStock"] )->name('admin.products.stock');
    Route::post("add-stock" , [ ProductsController::class , "addStock"] )->name('admin.products.stock.store');
    //update images
    Route::get("images/{id}" , [ ProductsController::class , "getImages"] )->name('admin.products.images');
    Route::post("add-image" , [ ProductsController::class , "addImages"] )->name('admin.products.images.store');
    Route::post("add-images" , [ ProductsController::class , "addDbImages"] )->name('admin.products.images.store.db');

});
######################### end tags routes ###############################
######################### Attributs routes ###############################
Route::prefix('attributs')->group(function () {
Route::get("/" , [ AttributesController::class , "index"] )->name('admin.attributs');
Route::get("create" , [ AttributesController::class , "create"] )->name('admin.attributs.create');
Route::post("add" , [ AttributesController::class , "store"] )->name('admin.attributs.store');
Route::get("delete/{id}" , [AttributesController::class , "destroy"])->name('admin.attributs.delete');
Route::get("edit/{id}" , [AttributesController::class , "edit"])->name('admin.attributs.edit');
Route::get("update/{id}" , [AttributesController::class , "update"])->name('admin.attributs.update');
});
######################### end Attributs routes ###############################
######################### Attributs routes ###############################
Route::prefix('options')->group(function () {
Route::get("/" , [ OptionsController::class , "index"] )->name('admin.options');
Route::get("create" , [ OptionsController::class , "create"] )->name('admin.options.create');
Route::post("add" , [ OptionsController::class , "store"] )->name('admin.options.store');
Route::get("delete/{id}" , [OptionsController::class , "destroy"])->name('admin.options.delete');
Route::get("edit/{id}" , [OptionsController::class , "edit"])->name('admin.options.edit');
Route::get("update/{id}" , [OptionsController::class , "update"])->name('admin.options.update');
});
######################### end Attributs routes ###############################
});
Route::group(['namespace'=>'Admin' , "middleware"=>'guest:admin' , 'prefix'=>'admin'] , function(){
    // هنا الحاجات اللى هتتنفذ والادمن مش مسجل دخول
   Route::get("login" , [LoginController::class , "index"])->name('admin.login.form');
   Route::post("admin-login" , [LoginController::class , "login"])->name('admin.login');
});

});




