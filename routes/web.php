<?php

use App\Http\Controllers\PegawaiAjaxController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pegawai', function () {
    return view('pegawai.index');
});

Route::resource('pegawai-ajax', PegawaiAjaxController::class);
Route::resource('products-ajax-crud', ProdukController::class);

//new one
Route::get('ajax-crud-datatable', [PegawaiAjaxController::class, 'index']);
Route::post('store', [PegawaiAjaxController::class, 'store']);
Route::post('edit', [PegawaiAjaxController::class, 'edit']);
Route::post('delete', [PegawaiAjaxController::class, 'destroy']);
