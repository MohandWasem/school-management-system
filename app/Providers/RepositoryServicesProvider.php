<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\TeacherRepositoryInterface',
            'App\Repository\TeacherRepository'
        );
        $this->app->bind(
            'App\Interfaces\StudentRepositoryInterface',
            'App\Repository\StudentRepository'
        );
        $this->app->bind(
            'App\Interfaces\PromotionRepositoryInterface',
            'App\Repository\PromotionRepository'
        );
        $this->app->bind(
            'App\Interfaces\GraduatedRepositoryInterface',
            'App\Repository\GraduatedRepository'
        );
        $this->app->bind(
            'App\Interfaces\FeesRepositoryInterface',
            'App\Repository\FeesRepository'
        );
        $this->app->bind(
            'App\Interfaces\FeesInvoiceRepositoryInterface',
            'App\Repository\FeesInvoiceRepository'
        );
        $this->app->bind(
            'App\Interfaces\ReceiptStudentRepositoryInterface',
            'App\Repository\ReceiptStudentRepository'
        );
        $this->app->bind(
            'App\Interfaces\ProcessingFeeRepositoryInterface',
            'App\Repository\ProcessingFeeRepository'
        );
        $this->app->bind(
            'App\Interfaces\PaymentRepositoryInterface',
            'App\Repository\PaymentRepository'
        );
        $this->app->bind(
            'App\Interfaces\AttendanceRepositoryInterface',
            'App\Repository\AttendanceRepository'
        );
        $this->app->bind(
            'App\Interfaces\SubjectRepositoryInterface',
            'App\Repository\SubjectRepository'
        );
        $this->app->bind(
            'App\Interfaces\QuizzRepositoryInterface',
            'App\Repository\QuizzRepository'
        );
        $this->app->bind(
            'App\Interfaces\QuestionRepositoryInterface',
            'App\Repository\QuestionRepository'
        );
        $this->app->bind(
            'App\Interfaces\OnlineClasseRepositoryInterface',
            'App\Repository\OnlineClasseRepository'
        );
        $this->app->bind(
            'App\Interfaces\LibraryRepositoryInterface',
            'App\Repository\LibraryRepository'
        );


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
