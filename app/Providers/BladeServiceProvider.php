<?php

namespace App\Providers;


use App\Helpers\BaseHelper;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('getIfEmpty', function ($expression) {
            return "<?php echo !empty($expression) ?  $expression : ''; ?>";
        });

        Blade::directive('assetUrl', function ($expression) {
            return "<?php echo !empty($expression) ?  asset($expression) : ''; ?>";
        });

        Blade::directive('asset', function ($expression) {
            return "<?php echo asset($expression); ?>";
        });

        Blade::directive('isDisplay', function ($expression) {
            return "<?php echo $expression ? 'HIển thị' : 'Không hiển thị' ; ?>";
        });

        Blade::directive('dateFormat', function ($expression) {
            return "<?php echo \App\Helpers\BaseHelper::dateTimeFormat($expression); ?>";
        });

        Blade::directive('trans', function ($expression) {
            return "<?php echo \App\Helpers\BaseHelper::echoLang($expression) ?>";
        });
    }

}