<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUpload;
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

Route::get('/', [FileUpload::class, 'index']);
Route::post('/', [FileUpload::class, 'upload_file'])->name('upload_file');
Route::get('/i/{file_id}', [FileUpload::class, 'get_file'])->name('url_file');
Route::get('/i/{file_id}/ip', [FileUpload::class, 'get_visits']);