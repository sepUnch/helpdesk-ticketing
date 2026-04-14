<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Employee\TicketController as EmployeeTicketController;
use App\Http\Controllers\ITSupport\TicketController as ITSupportTicketController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Employee Routes
Route::middleware(['auth', 'role:employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeTicketController::class, 'index'])->name('dashboard');
    Route::get('/tickets/create', [EmployeeTicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [EmployeeTicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [EmployeeTicketController::class, 'show'])->name('tickets.show');
});

// IT Support Routes
Route::middleware(['auth', 'role:it_support'])->prefix('it-support')->name('it-support.')->group(function () {
    Route::get('/dashboard', [ITSupportTicketController::class, 'index'])->name('dashboard');
    Route::get('/tickets/{ticket}', [ITSupportTicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/update-status', [ITSupportTicketController::class, 'updateStatus'])->name('tickets.update-status');
});