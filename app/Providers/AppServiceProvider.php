<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
       Model::preventLazyLoading(true);
        //*2 Gates, is a barrier, if you are authorize the gate open
        //Gate::define('edit-job', function(User $user, Job $job) {
          //  return $job->employer->user->is($user);
        //});
       //pagination configuration
       // Paginator::useBootstrap();

    }
}
