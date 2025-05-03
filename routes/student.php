<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/student/dashboard', function () {
            return view('pages.Students.dashboard');
        })->name('dashboard.Students');

        Route::group(['namespace' => 'Students\dashboard'], function () {
            Route::resource('student_exams', 'ExamsController');
            Route::get('student/exams/{id}/preview', 'ExamsController@preview')->name('student.exams.preview');
            Route::get('student/videoClass/{id}/preview', 'RecordedClassController@preview')->name('student.VideoClass.preview');
            Route::resource('profile-student', 'ProfileController');
            Route::prefix('student/homework-submissions')->name('student.submissions.')->group(function () {
                Route::get('/', 'HomeworkSubmissionController@index')->name('index'); // List of assigned homeworks
                Route::get('/{homework}/submit', 'HomeworkSubmissionController@create')->name('create'); // Submission form
                Route::post('/{homework}', 'HomeworkSubmissionController@store')->name('store'); // Submit file
                Route::get('/{homework}/view', 'HomeworkSubmissionController@show')->name('show'); // View submitted
            });
            Route::get('homeworks/{homework}/preview', 'HomeworkSubmissionController@preview')->name('student.homeworks.preview');
            Route::prefix('student/library')->name('student.library.')->group(function () {
                Route::get('/', 'LibraryController@index')->name('index'); // List of library books
                Route::get('/{book}/download', 'LibraryController@download')->name('download'); // Download book
            });
        });

        Route::group(['namespace' => 'Students'], function () {
            Route::get('student/subjects/{id}/materials', 'SubjectController@showSubjectContent')->name('student.subject.materials');
        });
    }
);
