<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\ChangePassword;
use Auth;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Session;

class ChangePasswordController extends Controller
{

    public function showForm(){
        return view('backend.account.change_password');
    }

    /*----- reset password ------*/
    
    public function postChangePassword(ChangePassword $request){
        try{

          $udata=User::find(Auth::guard('backend')->User()->id);
          $udata->password=Hash::make($request->password);
          $udata->update();
          return redirect()->route('backend.account.change-password')->with(['status'=>'success','message'=>'your password change successfully.']);

      }catch(\Exception $e){
        return redirect()->route('backend.account.change-password')->with(['status'=>'danger','message'=>'Oop`s something wents worng']);
    }
}

}
