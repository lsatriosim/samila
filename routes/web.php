<?php

use App\Http\Controllers\AnomalyController;
use App\Http\Controllers\UploadController;
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

Route::get('/', [UploadController::class, 'view']);

Route::post('/upload', [UploadController::class, 'proses_upload']);

Route::get('/detail/{userId}', [AnomalyController::class, 'view']);
