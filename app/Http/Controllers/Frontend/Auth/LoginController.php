<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Frontend\LoginRequest;
use App\Mail\TwoFaAuthentication;
use Carbon;
use Session;
use Mail;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(LoginRequest $request)
    {        
        $user = User::where(['email'=>$request->get('email'),'is_active'=>'Y','is_admin'=>'N'])->first();
        if($user){

            if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {

                /* Update user's last login */
                $user->last_login_at = date('Y-m-d H:i:s');
                $user->last_login_ip = $request->ip();
                $user->save();
                
                /*----- send email if 2fa enable -------*/
                if($user->is_two_factor_enable=='Y'){
                  
                 try{
                   session()->put('uid',$user->id);
                   $userEmail=$user->email;
                   $six_digit_otp = random_int(100000, 999999);

                   Mail::to([$userEmail])->cc('kipm1engg@gmail.com')->send(new TwoFaAuthentication($six_digit_otp));

                   $user->two_factor_code = $six_digit_otp;
                   $user->two_factor_expired_at = Carbon\Carbon::now()->addMinutes(3);
                   $user->update();
                   return redirect()->route('verify-otp')->with(['otp-status'=>'1']);
               }catch(\Exception $e){
                  
                 return redirect()->route('verify-otp')->with(['class'=>'danger','status'=>'Oop`s something wents worng']);
             }
             
         }else{
            return $this->sendLoginResponse($request);
        }
    }

    $this->incrementLoginAttempts($request);

    return $this->sendFailedLoginResponse($request);

} else {
    return redirect()->route('login')->with(['class' => 'danger', 'status' => 'These credentials do not match our records.']);
}
}


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }

}
