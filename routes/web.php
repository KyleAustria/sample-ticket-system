<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Models\Comment;

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

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::prefix('my')->middleware(['auth'])->group(function () {
    Route::prefix('tickets')->group(function () {

        Route::post('/', [TicketController::class, 'store'])->name('my.tickets.store');

        Route::get('/create', [TicketController::class, 'create'])->name('my.tickets.create');

        Route::get('/{id}', [TicketController::class, 'show'])->name('my.tickets.show');

        Route::put('/{id}', [TicketController::class, 'update'])->name('my.tickets.update');

        Route::delete('/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');

    });
});


Route::prefix('users')->middleware(['auth','auth.admin'])->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('users.index');

    Route::post('/', [UserController::class, 'store'])->name('users.store');

    Route::get('/create', [UserController::class, 'create'])->name('users.create');

    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');

    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');

    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');

});

// TICKET ROUTES

Route::prefix('tickets')->middleware(['auth','auth.admin'])->group(function () {

    Route::get('/', [TicketController::class, 'indexticket'])->name('tickets.index');

    Route::post('/', [TicketController::class, 'store'])->name('tickets.store');

    Route::get('/create', [TicketController::class, 'create'])->name('tickets.create');

    Route::get('/{id}', [TicketController::class, 'show'])->name('tickets.show');

    Route::put('/{id}', [TicketController::class, 'update'])->name('tickets.update');

    Route::delete('/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');

});

// COMMENTS

Route::prefix('comments')->middleware(['auth'])->group(function () {

    Route::post('/', [CommentController::class, 'store'])->name('comments.store');

    Route::delete('/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';
