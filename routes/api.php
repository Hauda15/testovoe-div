<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'App\Http\Controllers\UserController@register');
Route::get('/user', 'App\Http\Controllers\UserController@getUserDetails')->middleware('auth:sanctum');
Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');


Route::get('requests', [TicketController::class, 'index'])->name('requests.index');
Route::get('requests/create', [TicketController::class, 'create'])->name('requests.create');
Route::post('requests', [TicketController::class, 'store'])->name('requests.store');
Route::put('requests/{id}', [TicketController::class, 'update'])->name('requests.update');
Route::delete('requests/{id}', [TicketController::class, 'destroy'])->name('requests.destroy');
