<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\StudentsController;
use App\Http\Controllers\Backend\ReportsController;
use App\Http\Controllers\Backend\CommentsController;
use App\Http\Controllers\Backend\AttachmentsController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::group([
        'prefix' => 'admin',
    ], function () {
        Route::view('/', 'backend.dashboard')->name('dashboard');
        Route::group([
            'middleware' => 'check_role',
        ], function () {
            Route::get('/user/index', [UsersController::class, 'index'])->name('users.index');
            Route::get('/user/create', [UsersController::class, 'create'])->name('user.create');
            Route::post('/user/store', [UsersController::class, 'store'])->name('user.store');
            Route::post('/user/update/{id}', [UsersController::class, 'update'])->name('user.update');
            Route::any('/user/destroy/{id}', [UsersController::class, 'destroy'])->name('user.destroy');
        });
        Route::get('/user/show/{id}', [UsersController::class, 'show'])->name('user.show');

        Route::get('/student/index', [StudentsController::class, 'index'])->name('students.index');
        Route::get('/student/create', [StudentsController::class, 'create'])->name('student.create');
        Route::post('/student/store', [StudentsController::class, 'store'])->name('student.store');
        Route::get('/student/show/{id}', [StudentsController::class, 'show'])->name('student.show');
        Route::post('/student/update/{id}', [StudentsController::class, 'update'])->name('student.update');
        Route::any('/student/destroy/{id}', [StudentsController::class, 'destroy'])->name('student.destroy');

        Route::get('/report/index', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('/report/create', [ReportsController::class, 'create'])->name('report.create');
        Route::get('/report/test', [ReportsController::class, 'test'])->name('test');
        Route::post('/report/store', [ReportsController::class, 'store'])->name('report.store');
        Route::get('/report/show/{id}', [ReportsController::class, 'show'])->name('report.show');
        Route::post('/report/show_report', [ReportsController::class, 'show_report'])->name('show_report');
        Route::post('/report/update/{id}', [ReportsController::class, 'update'])->name('report.update');
        Route::any('/report/destroy/{id}', [ReportsController::class, 'destroy'])->name('report.destroy');

        Route::any('/comment/store', [CommentsController::class, 'store_comment'])->name('store_comment');

        Route::post('/delete_attachment', [AttachmentsController::class, 'delete_attachment'])->name('delete_attachment');
    });

});
