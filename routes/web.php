<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ExamBatchController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\StudentController;

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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/exam-batches', ExamBatchController::class);
    Route::get('/fetch-exam-batch', [ExamBatchController::class, 'fetchExamBatch'])->name('admin.exam-batches.fetch');
    Route::resource('/student', StudentController::class);
    Route::get('/fetch-student', [StudentController::class, 'fetchStudent'])->name('admin.student.fetch');
    Route::resource('/exam', ExamController::class);
});
