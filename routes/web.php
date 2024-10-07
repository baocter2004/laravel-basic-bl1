<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\FlagMiddleware;
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
    return view('welcome');
});

Route::middleware([FlagMiddleware::class])->group(function () {
    Route::resource('customers', CustomerController::class);

    Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])
        ->name('customers.forceDestroy');


    Route::get('/keke', function () {
        return view('welcome');
    })->withoutMiddleware('auth');
});
// nếu không đăng nhập thì sẽ chuyển sang trang login
Route::get('login', function () {
    echo "đây là trang login cơ!!!";
})->name('login');


Route::resource('employees', EmployeeController::class);
