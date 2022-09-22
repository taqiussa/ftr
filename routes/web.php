<?php

use App\Http\Livewire\Bon;
use App\Http\Livewire\Home;
use App\Http\Livewire\Laporan;
use App\Http\Livewire\Libur;
use App\Http\Livewire\Transaksi;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('transaksi', Transaksi::class)->name('transaksi');
    Route::get('bon', Bon::class)->name('bon');
    Route::get('libur', Libur::class)->name('libur');
    Route::get('laporan', Laporan::class)->name('laporan');
    Route::get('home', Home::class)->name('home');
});
Auth::routes();

