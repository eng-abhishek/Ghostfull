<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\Setting\Mailers;
use Illuminate\Support\Facades\Config;
use Schema;

class MailConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
               if(Schema::hasTable('mailers')) {

                $configuration = DB::table('mailers')->where("is_active",'Y')->first();

                if(!is_null($configuration)) {
                    $config = array(
                        'driver'     =>     $configuration->driver,
                        'host'       =>     $configuration->host,
                        'port'       =>     $configuration->port,
                        'username'   =>     $configuration->from_email,
                        'password'   =>     $configuration->password,
                        'encryption' =>     $configuration->encryption,
                        'from'       =>     array('address' => $configuration->from_email, 'name' => $configuration->from_name),
                        'sendmail'   => '/usr/sbin/sendmail -bs',
                        'pretend'    => false,
                    );
                    Config::set('mail', $config);
                }

               }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        

    }

}
