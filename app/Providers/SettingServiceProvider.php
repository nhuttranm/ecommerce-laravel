<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('settings', function ($app) {
            return new Setting();
        });
        $loader = AliasLoader::getInstance();
        $loader->alias('Setting', Setting::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // only use the Setting package if the Setting table is present in DB
        if(!App::runningInConsole() && count(Schema::getColumnListing('settings'))) {
            $settings = Setting::all();
            foreach ($settings as $setting) {
                Config::set('settings.'.$setting->key, $setting->value);
            }
        }
    }
}
