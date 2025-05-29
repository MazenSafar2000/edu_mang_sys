<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('App\Repository\TeacherRepositoryInterface', 'App\Repository\TeacherRepository');
        $this->app->bind('App\Repository\StudentRepositoryInterface', 'App\Repository\StudentRepository');
        $this->app->bind('App\Repository\StudentPromotionRepositoryInterface', 'App\Repository\StudentPromotionRepository');
        $this->app->bind('App\Repository\StudentGraduatedRepositoryInterface', 'App\Repository\StudentGraduatedRepository');
        $this->app->bind('App\Repository\SubjectRepositoryInterface', 'App\Repository\SubjectRepository');
        $this->app->bind('App\Repository\QuizzRepositoryInterface', 'App\Repository\QuizzRepository');
        $this->app->bind('App\Repository\QuestionRepositoryInterface', 'App\Repository\QuestionRepository');
        $this->app->bind('App\Repository\LibraryRepositoryInterface', 'App\Repository\LibraryRepository');


    }


    public function boot()
    {
        //
    }
}
