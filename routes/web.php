<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('social/{provider}', 'Auth\SocialiteController@redirectToProvider')->name('auth.socialite');
Route::get('social/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback');

Route::middleware('dashboard.locales')->group(function () {
    Auth::routes();
});

Route::impersonate();

Route::get('pages/{type}', 'PageController@show')->name('pages.show')->where('type', '(terms|privacy|about)');
Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('users', 'UserController')->only('edit', 'update');

Route::get('/', 'HomeController@welcome')->middleware('guest');
