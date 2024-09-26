<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::get('/', fn() => redirect()->route('login.index'));
Route::resource('login', LoginController::class)->only(['index', 'store']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('tickets/{ticket}/comments', [TicketController::class, 'storeComment'])->name('tickets.comments.store');
    Route::resource('tickets', TicketController::class);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
