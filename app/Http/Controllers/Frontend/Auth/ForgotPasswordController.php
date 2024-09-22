<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Http\Requests\Frontend\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function showLinkRequestForm()
    {
        return view('frontend.auth.passwords.email');
    }
    
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {

       $adminEmailID=User::where('is_admin','Y')->first()->email;
       if($adminEmailID==$request->email){
           return redirect()->back()->with(['class'=>'danger','status'=>'Oop`s this email id does not exist.']);
       }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
       $response = $this->broker()->sendResetLink(
        $this->credentials($request)
    );

       return $response == Password::RESET_LINK_SENT
       ? $this->sendResetLinkResponse($request, $response)
       : $this->sendResetLinkFailedResponse($request, $response);
   }


}
