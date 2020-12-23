<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/upload_file', [HomeController::class, 'upload'])->name('home.upload');
Route::get('/{path}', [HomeController::class, 'download']);
Route::post('/download', [HomeController::class, 'downloadFile']);
