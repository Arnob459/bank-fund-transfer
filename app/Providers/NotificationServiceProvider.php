<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Trx;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        view()->composer('*', function ($view) {
            if (auth()->check()) {
            // Retrieve notifications for the authenticated user
            $notifications = Trx::where('user_id', auth()->user()->id)->where(function ($query) {
                $query->where('remark', 'admin_added')->orWhere('remark', 'admin_subtract');})->latest()->paginate('3');


            // Share the notifications data with all views
            $view->with('notifications', $notifications);
            }
        });
    }
}
