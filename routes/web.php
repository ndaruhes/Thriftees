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


Auth::routes();

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // PAGES
    Route::get('/', 'PagesController@index')->name('allBarang');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // BARANG
    Route::get('barang', 'BarangController@index')->name('indexBarang');
    Route::get('barang/{id}/edit', 'BarangController@edit')->name('editBarang');
    Route::post('barang', 'BarangController@store')->name('storeBarang');
    Route::put('barang/{id}', 'BarangController@update')->name('updateBarang');
    Route::delete('barang/{id}', 'BarangController@destroy')->name('deleteBarang');
    Route::get('barang/{id}', 'BarangController@show')->name('showBarang');

    // KATEGORI
    Route::group(['middleware' => 'isAdmin'], function () {
        Route::resource('kategori', 'BarangController');
    });

    // PESANAN
    Route::group(['middleware' => 'isMember'], function () {
        Route::post('pesanan', 'PesananController@pesan')->name('pesanBarang');
    });

    Route::get('pesanan', 'PesananController@index')->name('indexPesanan');
    Route::put('pesanan/{id}', 'PesananController@accept')->name('terimaPesanan');
});
