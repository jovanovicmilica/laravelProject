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


Route::resource('suppliers',\App\Http\Controllers\SupplierController::class);
Route::resource('parts',\App\Http\Controllers\PartController::class);
Route::resource('supplier_parts',\App\Http\Controllers\SupprierPartController::class);

Route::get('/supplier/{supplier_id}/export', [\App\Http\Controllers\SupprierPartController::class, 'exportSupplierPartsToCSV']);

