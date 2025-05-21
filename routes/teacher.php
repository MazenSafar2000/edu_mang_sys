<?php

use App\Http\Controllers\Teachers\dashboard\RecordedClassController;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {

            $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
            $data['count_sections'] = $ids->count();
            $data['count_students'] = \App\Models\Student::whereIn('section_id', $ids)->count();

            //        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
            //        $count_sections =  $ids->count();
            //        $count_students = DB::table('students')->whereIn('section_id',$ids)->count();
            return view('pages.Teachers.dashboard.dashboard', $data);
        });

        Route::group(['namespace' => 'Teachers\dashboard'], function () {
            //==============================students============================
            Route::resource('recorded-classes', 'RecordedClassController');
            Route::get('student', 'StudentController@index')->name('student.index');
            Route::get('sections', 'StudentController@sections')->name('sections');
            Route::get('/teacher/student/{id}', 'StudentController@studentInformation')->name('teacher.student.info');
            Route::get('/teacher/sections/{section}/materials', 'StudentController@showMaterials')->name('materials');
            Route::resource('quizzes', 'QuizzController');
            Route::resource('questions', 'QuestionController');
            Route::resource('online_zoom_classes', 'OnlineZoomClassesController');
            Route::get('/indirect', 'OnlineZoomClassesController@indirectCreate')->name('indirect.teacher.create');
            Route::post('/indirect', 'OnlineZoomClassesController@storeIndirect')->name('indirect.teacher.store');
            Route::get('profile', 'ProfileController@index')->name('profile.show');
            Route::post('profile/{id}', 'ProfileController@update')->name('profile.update');
            Route::get('student_quizze/{id}', 'QuizzController@student_quizze')->name('student.quizze');
            Route::post('/manual-degree', 'QuizzController@storeManualDegree')->name('manual.degree.store');
            Route::post('repeat_quizze/{quizze_id}', 'QuizzController@repeat_quizze')->name('repeat.quizze');
            // Homework Routes (for teachers)
            Route::prefix('teacher/homeworks')->name('teacher.homeworks.')->group(function () {
                Route::get('/filter-classrooms/{grade_id}', 'HomeworkController@getClassrooms')->name('getClassrooms');
                Route::get('/filter-sections/{class_id}', 'HomeworkController@getSections')->name('getSections');
                Route::get('/filter-subjects/{grade_id}/{class_id}/{section_id}', 'HomeworkController@getSubjects')->name('getSubjects');

                Route::get('/', 'HomeworkController@index')->name('index');
                Route::get('/create', 'HomeworkController@create')->name('create');
                Route::post('/', 'HomeworkController@store')->name('store');
                Route::get('/{homework}', 'HomeworkController@show')->name('show');

                Route::get('homeworks/{homework}/submissions', 'HomeworkController@showSubmissions')->name('submissions');
                // Route::put('homeworks/submissions/{submission}/grade', 'HomeworkController@gradeSubmission')->name('grade');
                Route::post('homeworks/{homework}/grade/{student}', 'HomeworkController@gradeStudent')->name('grade');

                Route::get('teacher/homeworks/{id}/edit', 'HomeworkController@edit')->name('edit');
                Route::put('teacher/homeworks/{id}', 'HomeworkController@update')->name('update');
                Route::delete('teacher/homeworks/{id}', 'HomeworkController@destroy')->name('destroy');
            });
            Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
            Route::resource('library', 'LibraryController');
        });

        Route::get('teacher/notification/{id}', 'NotificationController@teacherRead')->name('teacher.notification.read');
    }
);
