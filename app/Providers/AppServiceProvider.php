<?php

namespace App\Providers;

use App\Models\DonationReport;
use App\Models\Donor;
use App\Policies\DonationReportPolicy;
use App\Policies\DonorPolicy;
use Illuminate\Support\ServiceProvider;
use App\Models\Warehouse;
use App\Policies\WarehousePolicy;
use App\Models\InventoryItem;
use App\Policies\InventoryItemPolicy;
use Illuminate\Support\Facades\Gate;

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
        Gate::policy(Warehouse::class, WarehousePolicy::class);
        Gate::policy(InventoryItem::class, InventoryItemPolicy::class); 



    }
}
