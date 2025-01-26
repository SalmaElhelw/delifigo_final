<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseServiceProvider;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        // تعريف المسارات الخاصة بالـ API
        Route::group([
            'middleware' => 'api',
            'prefix' => 'api', // تأكد من تحديد البريفكس هنا إذا كنت تستخدم الـ API
        ], function () {
            require base_path('routes/api.php');
        });

        // تعريف المسارات الخاصة بالـ Web
        Route::group([
            'middleware' => 'web',
        ], function () {
            require base_path('routes/web.php');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // يمكن إضافة خدمات أخرى هنا إذا كنت بحاجة
    }
}
