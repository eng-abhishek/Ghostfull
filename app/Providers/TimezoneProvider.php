<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\Config;
use Schema;

class TimezoneProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       if(Schema::hasTable('settings')){

        $timezone = DB::table('settings')->where("key",'website_timezone')->first();
        $app_timezone=(!empty($timezone)) ? $timezone->value : 'Asia/Kolkata';
        Config::set('app.timezone', $app_timezone);

        }
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
