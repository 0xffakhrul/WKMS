<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/employees', [EmployeeController::class, 'index'])->name('admin.employees.index');

    Route::get('/admin/employees/create', [EmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('/admin/employees', [EmployeeController::class, 'store'])->name('admin.employees.store');
    Route::get('/admin/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('admin.employees.edit');
    Route::put('/admin/employees/{employee}', [EmployeeController::class, 'update'])->name('admin.employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('admin.employees.destroy');

    Route::get('/admin/leaves', [LeaveController::class, 'index'])->name('admin.leaves.index');
    Route::post('/admin/leaves', [LeaveController::class, 'store'])->name('admin.leaves.store');
    Route::get('/admin/leaves/create', [LeaveController::class, 'create'])->name('admin.leaves.create');
    Route::get('/admin/leaves/{leave}/edit', [LeaveController::class, 'edit'])->name('admin.leaves.edit');
    Route::put('/admin/leaves/{leave}', [LeaveController::class, 'update'])->name('admin.leaves.update');
    Route::post('/admin/leaves/{leave}/reject', [LeaveController::class, 'reject'])
        ->name('admin.leaves.reject');
    Route::delete('/leaves/{leave}', [LeaveController::class, 'destroy'])->name('admin.leaves.destroy');


    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/admin/attendances', [AttendanceController::class, 'index'])->name('admin.attendances.index');

    Route::get('/admin/payrolls', [PayrollController::class, 'index'])->name('admin.payrolls.index');
    Route::get('/admin/payrolls/create', [PayrollController::class, 'create'])->name('admin.payrolls.create');
    Route::get('/admin/payrolls/{payroll}', [PayrollController::class, 'show'])->name('admin.payrolls.show');
});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'StaffDashboard'])->name('staff.dashboard');
    Route::get('/staff/leaves', [LeaveController::class, 'empIndex'])->name('staff.leaves.index');
    Route::get('/staff/leaves/create', [LeaveController::class, 'empCreate'])->name('staff.leaves.create');
    Route::post('/staff/leaves', [LeaveController::class, 'empStore'])->name('staff.leaves.store');
    Route::get('/staff/leaves/{leave}', [LeaveController::class, 'show'])->name('staff.leaves.show');

    Route::get('/staff/attendances', [AttendanceController::class, 'empIndex'])->name('staff.attendances.index');
    Route::get('/staff/attendances/create', [AttendanceController::class, 'empCreate'])->name('staff.attendances.create');
    Route::post('/staff/attendances', [AttendanceController::class, 'empStore'])->name('staff.attendances.store');

    Route::get('/staff/payrolls', [PayrollController::class, 'empIndex'])->name('staff.payrolls.index');
    Route::get('/staff/payrolls/{payroll}', [PayrollController::class, 'empShow'])->name('staff.payrolls.show');
});
