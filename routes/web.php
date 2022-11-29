<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;

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

Route::get('/', fn () => redirect()-> route('login') );

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/kategori/data', [Kategoricontroller::class, 'data'])->name('kategori.data');
    Route::resource('/kategori', KategoriController::class);

    Route::get('/produk/data', [Produkcontroller::class, 'data'])->name('produk.data');
    Route::post('/produk/delete-selected', [Produkcontroller::class, 'deleteSelected'])->name('produk.delete_selected');
    Route::post('/produk/cetak-barcode', [Produkcontroller::class, 'cetakBarcode'])->name('produk.cetak_barcode');
    Route::resource('/produk', ProdukController::class);
});