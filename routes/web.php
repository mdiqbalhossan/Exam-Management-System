<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ExamBatchController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

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
    return view('frontend.index');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

// User Authentication
Route::get('/user/login',[AuthController::class, 'login'])->name('user.login');
Route::post('/user/login',[AuthController::class, 'login_check'])->name('user.login.post');
Route::get('/user/register',[AuthController::class, 'register'])->name('user.register');
Route::post('/user/register',[AuthController::class, 'register_check'])->name('user.register.post');
Route::get('/forgot/id',[AuthController::class, 'forgot'])->name('user.forgot');
Route::post('/forgot/id',[AuthController::class, 'forgot_check'])->name('user.forgot.post');

// User Route Group
Route::group(['prefix' => 'user', 'middleware' => 'auth:student'], function(){
    Route::get('/dashboard',[UserDashboardController::class, 'index'])->name('dashboard');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/exam-batches', ExamBatchController::class);
    Route::get('/fetch-exam-batch', [ExamBatchController::class, 'fetchExamBatch'])->name('admin.exam-batches.fetch');
    Route::resource('/student', StudentController::class);
    Route::get('/fetch-student', [StudentController::class, 'fetchStudent'])->name('admin.student.fetch');
    Route::resource('/exam', ExamController::class);

    // Question Route
    Route::get('/question/exam/{id}',[QuestionController::class, 'index'])->name('question.index');
    Route::get('/question/create',[QuestionController::class, 'create'])->name('question.create');
    Route::post('/question/store',[QuestionController::class, 'store'])->name('question.store');
});
