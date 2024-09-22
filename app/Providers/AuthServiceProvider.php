<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Hashing\BcryptHasher as Hasher;
use Illuminate\Support\Facades\Crypt;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Validator::extend('captcha', function($attribute, $value, $parameters, $validator){

            if (!\Session::has('captcha')) {
                return false;
            }

            $key = \Session::get('captcha.key');
            $sensitive = \Session::get('captcha.sensitive');
            $encrypt = \Session::get('captcha.encrypt');

            if (!$sensitive) {
                $value = \Str::lower($value);
            }

            if($encrypt) $key = Crypt::decrypt($key);

            $hasher = new Hasher();
            $check = $hasher->check($value, $key);

            return $check;
            
        }, 'Captcha code is invalid.'); 
        //
    }
}
