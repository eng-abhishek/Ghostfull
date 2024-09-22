<?php

namespace App\Http\Middleware;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if(auth()->check() && !empty($user->two_factor_code) && $user->is_two_factor_enable == 'Y'){
            return redirect()->route('verify-otp');
        }
        return $next($request);
    }
}