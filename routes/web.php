<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

Route::match(['get', 'post'],'/admin/allbin', 'AdminController@allbin')->name('admin.allbin');

Route::match(['get', 'post'],'/admin/insertBin', 'AdminController@insertBin')->name('admin.insertBin');

Route::match(['get', 'post'],'/admin/syncbin', 'AdminController@syncbin')->name('admin.syncbin');

Route::match(['get', 'post'],'/fetch/syncbin/{id}', 'SyncController@syncbin')->name('fetch.syncbin');
