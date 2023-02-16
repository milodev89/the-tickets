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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\TicketController::class, 'index'])->name('welcome');
Route::get('/home', [App\Http\Controllers\TicketController::class, 'dashboard'])->name('home');
Route::post('/tickets/show_tickets', [App\Http\Controllers\TicketController::class, 'show_tickets']);
Route::post('/tickets/store', [App\Http\Controllers\TicketController::class, 'store']);
Route::post('/tickets/show_ticket', [App\Http\Controllers\TicketController::class, 'show_ticket']);
Route::patch('/tickets/update', [App\Http\Controllers\TicketController::class, 'update']);
Route::post('/tickets/delete', [App\Http\Controllers\TicketController::class, 'destroy']);
