<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\TwoFaAuthentication;
use App\Models\User;
use Carbon;
use Session;
use Mail;

class TwoFactorController extends Controller
{

    /*------- use to open 2fa screen-----*/ 
    public function verifyOTP(){
        return view('frontend.auth.two_fa_verify_otp');
    }

    /*------- use to check valid otp-----*/
    public function postVerifyOTP(Request $request){
     
        if(empty(session()->get('uid'))){
            return redirect()->route('verify-otp')->with(['class'=>'danger','status'=>'Your otp will be expire.']);
        } 
        
        $udata=User::where('id',session()->get('uid'))->first();   
        if(strtotime($udata->two_factor_expired_at) < strtotime(now()))
        {
            return redirect()->route('verify-otp')->with(['class'=>'danger','status'=>'Your otp will be expire.']);
        }else{
            if($udata->two_factor_code==$request->two_factor_code){

                try{
                    session()->forget('uid');
                    $udata->two_factor_expired_at = null;
                    $udata->two_factor_code = null;
                    $udata->update();
                    return redirect()->route('home')->with(['status'=>'Your email verify successfully.']);

                }catch(\Exception $e){

                 return redirect()->route('verify-otp')->with(['class'=>'danger','status'=>'Oop`s something wents worng']);
             }
         }else{
            return redirect()->route('verify-otp')->with(['class'=>'danger','status'=>'Please enter correct otp.']);
        }
    }
}

/*------- use to resend otp-----*/
public function resendOTP(){
  
    if(empty(session()->get('uid'))){
        return redirect()->route('verify-otp')->with(['class'=>'danger','status'=>'Your otp will be expire.']);
    }
    
    try{
        
        $user=User::where('id',session()->get('uid'))->first();
        $userEmail = $user->email;
        $six_digit_otp = random_int(100000, 999999);

        Mail::to([$userEmail])->cc('kipm1engg@gmail.com')->send(new TwoFaAuthentication($six_digit_otp));

        $user->two_factor_code = $six_digit_otp;
        $user->two_factor_expired_at = Carbon\Carbon::now()->addMinutes(3);
        $user->update();
        return redirect()->route('verify-otp')->with(['otp-status'=>'1']);

    }catch(\Exception $e){
        return redirect()->route('account.change-password')->with(['class'=>'danger','status'=>'Oop`s something wents worng']);
    }
}

}
