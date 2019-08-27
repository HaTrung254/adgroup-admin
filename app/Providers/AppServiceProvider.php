<?php

namespace App\Providers;

use App\Models\Categories;
use App\Helpers\BaseHelper;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view) {
            $language = Session::get(BaseHelper::LANG_SESSION_NAME);
            $productCates = Categories::getProductDisplay($language);
            view()->share('productCates', $productCates); 
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
