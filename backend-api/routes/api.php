<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Menambahkan route menggunakan resource dari laravel secara otomatis semua route sudah dibuat
Route::resource('/post', Post_Controller::class);

//Jika tidak memakai route::resource dari laravel maka harus membuat masing2 route seperti dibawah ini

// Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
// Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
// Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
// Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
// Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);
