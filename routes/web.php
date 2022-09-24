<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ExamBatchController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\Note\NoteController;
use App\Http\Controllers\Admin\Note\StudentClassController;
use App\Http\Controllers\Admin\Note\StudentGroupController;
use App\Http\Controllers\Admin\Note\SubjectController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\DetailsController;
use App\Http\Controllers\User\ExamController as UserExamController;
use App\Http\Controllers\User\NoteController as UserNoteController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/details/{id}', [DetailsController::class, 'index'])->name('details');
Route::get('/note',[UserNoteController::class, 'class'])->name('user.note');
Route::get('/note/{class_slug}',[UserNoteController::class, 'group'])->name('user.group');
Route::get('/note/{class_slug}/{group_slug}',[UserNoteController::class, 'subject'])->name('user.subject');
Route::get('/note/{class_slug}/{group_slug}/{subject_slug}',[UserNoteController::class, 'note'])->name('user.note.download');


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
Route::get('/user/logout',[AuthController::class, 'logout'])->name('user.logout');

// User Route Group
Route::group(['prefix' => 'user', 'middleware' => 'auth:student'], function(){
    Route::get('/dashboard',[UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/exam/{id}', [UserExamController::class, 'index'])->name('exam');
    Route::post('/exam/store/{id}', [UserExamController::class, 'store'])->name('exam.result.store');
    Route::get('/success',[UserExamController::class, 'success'])->name('success');
    Route::get('/result/{exam_id}',[UserExamController::class,'viewResult'])->name('view.user.result');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/exam-batches', ExamBatchController::class);
    Route::get('/fetch-exam-batch', [ExamBatchController::class, 'fetchExamBatch'])->name('admin.exam-batches.fetch');
    Route::resource('/student', StudentController::class);
    Route::get('/fetch-student', [StudentController::class, 'fetchStudent'])->name('admin.student.fetch');
    Route::get('/accepted/{id}',[StudentController::class, 'accepted']);
    Route::get('/cancelled/{id}',[StudentController::class, 'cancelled']);
    Route::resource('/exam', ExamController::class);
    Route::get('/activate/{id}',[ExamController::class, 'activate']);
    Route::get('/deactivate/{id}',[ExamController::class, 'deactivate']);
    Route::get('/view/result/{id}',[ExamController::class, 'viewResult'])->name('view.result');

    // Question Route
    Route::get('/question/exam/{id}',[QuestionController::class, 'index'])->name('question.index');
    Route::get('/question/create',[QuestionController::class, 'create'])->name('question.create');
    Route::post('/question/store',[QuestionController::class, 'store'])->name('question.store');
    Route::get('/question/edit/{id}',[QuestionController::class, 'edit'])->name('question.edit');
    Route::post('/question/update/{id}',[QuestionController::class, 'update'])->name('question.update');
    Route::get('/question/destroy/{id}',[QuestionController::class, 'destroy']);

    // Student Note Route
    Route::prefix('notes')->group(function(){
        Route::resource('classes',StudentClassController::class);
        Route::get('/fetch-class', [StudentClassController::class, 'fetchClass'])->name('admin.class.fetch');
        Route::resource('group',StudentGroupController::class);
        Route::get('/fetch-group', [StudentGroupController::class, 'fetchGroup'])->name('admin.group.fetch');
        Route::resource('/subject',SubjectController::class);
        Route::get('/fetch-subject', [SubjectController::class, 'fetchSubject'])->name('admin.subject.fetch');
        Route::resource('/note',NoteController::class);
        Route::get('/fetch-note', [NoteController::class, 'fetchNote'])->name('admin.note.fetch');
    });
});
