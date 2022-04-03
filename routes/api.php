<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'apiLogin'])->name('users.login');

Route::middleware(['auth:api'])->group(function () {
    Route::get('my', [UserController::class, 'profile'])->name('myprofile');
});

Route::prefix('users')->middleware(['auth:api'])->group(function () {

    Route::get('/', [UserController::class, 'apiGetAll'])->name('users.getAll');

    Route::get('/{id}', [UserController::class, 'apiGetOne'])->name('users.getOne');

    Route::post('/', [UserController::class, 'apiCreateUser'])->name('users.createUser');

    Route::put('/{id}', [UserController::class, 'apiUpdate'])->name('users.updateUser');

    Route::delete('/{id}', [UserController::class, 'apiDelete'])->name('users.destroy');

});


Route::prefix('tickets')->middleware(['auth:api'])->group(function () {

    Route::get('/', [TicketController::class, 'apiGetAllTicket'])->name('tickets.getAll');

    Route::get('/{id}', [TicketController::class, 'apiGetOneTicket'])->name('tickets.getOne');

    Route::post('/', [TicketController::class, 'apiCreateTicket'])->name('tickets.createTicket');

    Route::put('/{id}', [TicketController::class, 'apiUpdateTicket'])->name('tickets.updateTicket');

    Route::delete('/{id}', [TicketController::class, 'apiDeleteTicket'])->name('tickets.destroy');

});

Route::prefix('ticket')->middleware(['auth:api'])->group(function () {
Route::get('/{id}', [TicketController::class, 'apiRole'])->name('tickets.getAllrole');
});
