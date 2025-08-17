<?php

namespace App\Providers;

use App\Models\DonationReport;
use App\Models\Donor;
use App\Policies\DonationReportPolicy;
use App\Policies\DonorPolicy;
use Gate;
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
        Gate::policy(Donor::class, DonorPolicy::class);
        Gate::policy(DonationReport::class, DonationReportPolicy::class);

    }
}
