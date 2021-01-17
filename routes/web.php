<?php

use App\Models\Empresa;
use App\Models\LibroDiario;
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
    if (Auth::check()){
        return view('home');
    }else{
        return view('auth.login');
    }

});


Auth::routes();

Route::get('/home/{error?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('/dashboard', App\Http\Controllers\DashboardController::class)->middleware('auth');
Route::resource('/empresa', App\Http\Controllers\EmpresaController::class)->middleware('auth');
Route::resource('/librod', App\Http\Controllers\LibroDiarioController::class)->middleware('auth');
Route::resource('/librom', App\Http\Controllers\LibroMayorController::class)->middleware('auth');
Route::resource('/registrold', App\Http\Controllers\RegistroldController::class)->middleware('auth');
Route::resource('/registrolm', App\Http\Controllers\RegistrolmController::class)->middleware('auth');
Route::resource('/cuenta', App\Http\Controllers\CuentaController::class)->middleware('auth');
Route::resource('/subcuenta', App\Http\Controllers\SubcuentaController::class)->middleware('auth');

//no se pueden llamar igual que sus rutas originales de resource
Route::get('/subcuentas/{id?}', [App\Http\Controllers\SubcuentaController::class, 'subcuentas'])->middleware('auth');

Route::get('/registrosporlibro/{id}', [App\Http\Controllers\RegistroldController::class, 'registrosLibro'])->middleware('auth');

Route::get('/PDF/report1/{id?}', [App\Http\Controllers\PDFController::class, 'report1'])->middleware('auth');

Route::get('/balanza', [App\Http\Controllers\BalanzaController::class, 'balanza'])->name('balanza')->middleware('auth');
