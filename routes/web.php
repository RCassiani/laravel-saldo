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

    //Saldo
    $this->get('balance', 'BalanceController@index')->name('admin.balance');

    //Depósito
    $this->get('deposit', 'BalanceController@deposit')->name('balance.deposit');
    $this->post('deposit', 'BalanceController@depositStore')->name('deposit.store');

    //Saque
    $this->get('withdraw', 'BalanceController@withdraw')->name('balance.withdraw');
    $this->post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');

    //Transferência
    $this->get('transfer', 'BalanceController@transfer')->name('balance.transfer');
    $this->post('confirm-transfer', 'BalanceController@transferConfirm')->name('transfer.confirm');
    $this->post('transfer', 'BalanceController@transferStore')->name('transfer.store');

    //Historico
    $this->get('historic-search', 'BalanceController@historic')->name('balance.historic');
    $this->any('historic', 'BalanceController@searchHistoric')->name('historic.search');
});

Route::get('meu-perfil', 'Admin\UserController@profile')->name('profile')->middleware('auth');
Route::post('atualizar-perfil', 'Admin\UserController@profileUpdate')->name('profile.update')->middleware('auth');

Route::get('/', 'Site\SiteController@index')->name('site');

Auth::routes();
