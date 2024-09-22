<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\Frontend\EditProfileRequest;
use Auth;
use Illuminate\Support\Facades\Storage;

class EditProfileController extends Controller
{

  public function showForm(){
    $data['country']=Country::all();
    $data['udata']=User::find(Auth::User()->id);
    $data['address']=json_decode($data['udata']->address);
    return view('frontend.account.edit_profile',$data);
  }

  /*-------- update profile ---*/

  public function postEditProfile(EditProfileRequest $request){
    try{

      $udata=User::find(Auth::User()->id);
      $address = [
        'address' => $request->address,
        'city' => $request->city,
        'state' => $request->state,
        'zipcode' => $request->zipcode,
        'country' => $request->country,
      ];

      $udata->firstname = $request->firstname;
      $udata->lastname = $request->lastname;
      $udata->username = $request->username;
      $udata->email = $request->email;
      $udata->address = $address;
      $udata->phone_number = $request->phone_number;

      if(!empty($request->is_two_factor_enable)){
        $udata->is_two_factor_enable = 'Y';
      }else{
        $udata->is_two_factor_enable = 'N';
      }

      $udata->update();

      return redirect()->route('account.profile')->with(['status'=>'success','message'=>'your profile updated successfully.']);

    }catch(\Exception $e){
      return redirect()->route('account.profile')->with(['status'=>'danger','message'=>'Oop`s something wents worng']);
    }
  }


  /*-------- update profile picture ---*/
  public function postUpdateProfilePic(Request $request){
    try{


      if($request->hasFile('avatar')) {

        $avatar = User::find(Auth::User()->id)->avatar;
        /*--- remove image from folder ---*/
        if(!empty($avatar)){

          $removeImg = public_path().'/storage/avatars/'.auth()->user()->avatar;
          unlink($removeImg);
        }
        
        $document_path = 'avatars';

        if (!\Storage::exists($document_path)) {

          \Storage::makeDirectory($document_path, 0777);
        }
        $banner_one_filename = pathinfo($request->file('avatar')->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'_'.$request->file('avatar')->getClientOriginalExtension();
        $request->file('avatar')->storeAs($document_path, $banner_one_filename);
        
        $udata = User::find(Auth::User()->id);
        $udata->avatar = $banner_one_filename;
        $udata->update();

        return redirect()->route('account.profile')->with(['status'=>'success','message'=>'your profile picture updated successfully.']);
      }
    }catch(\Exception $e){

     return redirect()->route('account.profile')->with(['status'=>'danger','message'=>'Oop`s something wents worng']);
   }
 }
}
