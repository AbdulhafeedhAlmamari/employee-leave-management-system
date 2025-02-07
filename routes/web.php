<?php

use App\Http\Controllers\Client\LeaveRequestController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::get('/register', function () {
    return view('welcome');
})->name('register');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', [LeaveRequestController::class, 'index'])->name('home');
    Route::post('/leave_requests', [LeaveRequestController::class, 'store'])->name('leave_requests.store');
    Route::get('/leave_requests/create', [LeaveRequestController::class, 'create'])->name('leave_requests.create');
    Route::delete('/home/{leaveRequest}', [LeaveRequestController::class, 'destroy'])->name('leave_requests.destroy');
    Route::get('/leave_requests/{leaveRequest}/edit', [LeaveRequestController::class, 'edit'])->name('leave_requests.edit');
    Route::put('/leave_requests/{leaveRequest}', [LeaveRequestController::class, 'update'])->name('leave_requests.update');
    Route::get('/leave_requests/{leaveRequest}', [LeaveRequestController::class, 'show'])->name('leave_requests.show');

    Route::get('/leave-report', [LeaveRequestController::class, 'generateLeaveReport'])->name('leave.report');
});

// require_once __DIR__ . '/jetstream.php';
require_once __DIR__ . '/fortify.php';
