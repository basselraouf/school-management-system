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
            'App\Repositories\Teacher\TeacherRepository',
        );

        $this->app->bind(
            'App\Repositories\Student\StudentRepositoryInterface',
            'App\Repositories\Student\StudentRepository',
        );

        $this->app->bind(
            'App\Repositories\Student\PromotionRepositoryInterface',
            'App\Repositories\Student\PromotionRepository',
        );

        $this->app->bind(
            'App\Repositories\Student\GraduationRepositoryInterface',
            'App\Repositories\Student\GraduationRepository',
        );

        $this->app->bind(
            'App\Repositories\Student\FeesRepositoryInterface',
            'App\Repositories\Student\FeesRepository',
        );

        $this->app->bind(
            'App\Repositories\Student\FeeInvoicesRepositoryInterface',
            'App\Repositories\Student\FeeInvoicesRepository',
        );

        $this->app->bind(
            'App\Repositories\Student\ReceiptStudentsRepositoryInterface',
            'App\Repositories\Student\ReceiptStudentsRepository',
        );

        $this->app->bind(
            'App\Repositories\Student\ProcessingFeeRepositoryInterface',
            'App\Repositories\Student\ProcessingFeeRepository',
        );

        $this->app->bind(
            'App\Repositories\Student\AttendanceRepositoryInterface',
            'App\Repositories\Student\AttendanceRepository',
        );

        $this->app->bind(
            'App\Repositories\Student\SubjectRepositoryInterface',
            'App\Repositories\Student\SubjectRepository',
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
