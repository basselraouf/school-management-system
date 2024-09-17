<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Repositories\Teacher\TeacherRepositoryInterface',
            'App\Repositories\Teacher\TeacherRepository'
        );

        $this->app->bind(
            'App\Repositories\Student\StudentRepositoryInterface',
            'App\Repositories\Student\StudentRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
