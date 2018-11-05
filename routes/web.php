<?php

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

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'],function (){
    $this->get('/', 'AdminController@index')->name('admin.home');

    $this->get('balance', 'BalanceController@index')->name('admin.balance');
    $this->get('deposit', 'BalanceController@deposit')->name('balance.deposit');    $this->get('balance/deposit', 'BalanceController@deposit')->name('balance.deposit');

    $this->post('deposit', 'BalanceController@depositStore')->name('deposit.store');    $this->get('balance/deposit', 'BalanceController@deposit')->name('balance.deposit');
});

Route::get('/', 'Site\SiteController@index')->name('site');

Auth::routes();
