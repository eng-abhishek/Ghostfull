<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\ChangePasswordRequest;
use Auth;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showForm(){
        return view('frontend.account.change_password');
    }

    /*---------- change password -----------*/
    
    public function postChangePassword(ChangePasswordRequest $request){
     try{

        $udata = User::find(Auth::User()->id);
        $udata->password = Hash::make($request->password);
        $udata->update();
        return redirect()->route('account.profile')->with(['status'=>'success','message'=>'your password change successfully.']);

    }catch(\Exception $e){
        return redirect()->route('account.change-password')->with(['status'=>'danger','message'=>'Oop`s something wents worng']);
    }
}
}
