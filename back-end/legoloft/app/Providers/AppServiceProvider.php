<?php

namespace App\Providers;

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
        // View::composer là một cơ chế để chia sẻ dữ liệu giữa các view một cách dễ dàng
        view()->composer('*', function ($view) {
            $admin = auth()->guard('admin')->user();
            $permission = $admin ? json_decode($admin->administrationGroup->permission) : [];
            $view->with(compact('permission'));
        });
    }
}
