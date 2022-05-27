<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('site.home');
    })->name('home');
Route::group([
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){

    Route::group(['namespace'=>'Admin' , "middleware"=>'auth' , 'prefix'=>'site'] , function(){
        // هنا الحاجات اللى هتتنفذ والادمن مسجل دخول

    });
    Route::group(['namespace'=>'Admin' , "middleware"=>'guest:admin' , 'prefix'=>'admin'] , function(){
        // هنا الحاجات اللى هتتنفذ والادمن مش مسجل دخول
    });
});
