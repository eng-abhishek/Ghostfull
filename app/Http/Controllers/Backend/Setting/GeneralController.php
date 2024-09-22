<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\General;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Setting\GeneralSettingRequest;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
     
      $setting_value=General::all();

      $data['website_name']=General::where('key','website_name')->first();
      $data['website_url']=General::where('key','website_url')->first();
      $data['contact_person_name']=General::where('key','contact_person_name')->first();
      $data['contact_person_email']=General::where('key','contact_person_email')->first();
      $data['website_timezone']=General::where('key','website_timezone')->first();
      $removefile=General::where('key','expired_subscription_file_delete_after')->first();

      $data['remove_file']=(!empty($removefile)) ? $removefile['value']:'';

      $dark_logo=General::where('key','website_dark_logo')->first();
      $light_logo=General::where('key','website_light_logo')->first();
      $fevicon_icon=General::where('key','website_fevicon_icon')->first();

      $data['website_dark_logo']=(!$dark_logo) ? '' : $dark_logo['value'];
      $data['website_light_logo']=(!$light_logo) ? '' : $light_logo['value'];
      $data['website_fevicon_icon']=(!$fevicon_icon) ? '' : $fevicon_icon['value'];

      return view('backend.setting.general.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(General $general)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(General $general)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(GeneralSettingRequest $request, General $general)
    {

      try{

        $website_name=General::where('key','website_name')->first();
        $website_url=General::where('key','website_url')->first();
        $contact_person_name=General::where('key','contact_person_name')->first();

        $contact_person_email=General::where('key','contact_person_email')->first();

        $website_timezone=General::where('key','website_timezone')->first();

        $expired_subscription_file_delete_after=General::where('key','expired_subscription_file_delete_after')->first();

        $website_dark_logo=General::where('key','website_dark_logo')->first();
        $website_light_logo=General::where('key','website_light_logo')->first();
        $website_fevicon_icon=General::where('key','website_fevicon_icon')->first();

        if(empty($website_name)){
          $insert = new General;
          $insert->key='website_name';
          $insert->value=$request->website_name;
          $insert->save();

        }else{

          $website_name->value=$request->website_name;
          $website_name->save();
        }


        if(empty($website_url)){
          $insert = new General;
          $insert->key='website_url';
          $insert->value=$request->website_url;
          $insert->save();

        }else{

          $website_url->value=$request->website_url;
          $website_url->save();
        }


        if(empty($contact_person_name)){
          $insert = new General;
          $insert->key='contact_person_name';
          $insert->value=$request->contact_person_name;
          $insert->save();

        }else{

          $contact_person_name->value=$request->contact_person_name;
          $contact_person_name->save();
        }

        if(empty($contact_person_email)){
          $insert = new General;
          $insert->key='contact_person_email';
          $insert->value=$request->contact_person_email;
          $insert->save();

        }else{

          $contact_person_email->value=$request->contact_person_email;
          $contact_person_email->save();
        }

        if(empty($website_timezone)){
          $insert = new General;
          $insert->key='website_timezone';
          $insert->value=$request->website_timezone;
          $insert->save();

        }else{

          $website_timezone->value=$request->website_timezone;
          $website_timezone->save();
        }

        if(empty($expired_subscription_file_delete_after)){
          $insert = new General;
          $insert->key='expired_subscription_file_delete_after';
          $insert->value=$request->expired_subscription_file_delete_after;
          $insert->save();

        }else{

          $expired_subscription_file_delete_after->value=$request->expired_subscription_file_delete_after;
          $expired_subscription_file_delete_after->save();
        }

        /*----------- logo part ------------*/


        if($request->hasFile('website_dark_logo')){

          /*--- remove image from folder ---*/
          if(!empty($website_dark_logo['key'])){

            $remove_dark_logo=public_path().'/storage/logo/'.$website_dark_logo['value'];
            unlink($remove_dark_logo);

          }
          
          $document_path = 'logo';
          
          if (!\Storage::exists($document_path)) {

            \Storage::makeDirectory($document_path, 0777);
          }
          $dark_logo_filename = pathinfo($request->file('website_dark_logo')->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'_'.$request->file('website_dark_logo')->getClientOriginalExtension();
          $request->file('website_dark_logo')->storeAs($document_path, $dark_logo_filename);

          if(empty($website_dark_logo['key'])){
            $insert = new General;
            $insert->key='website_dark_logo';
            $insert->value=$dark_logo_filename;
            $insert->save();

          }else{

            $website_dark_logo->value=$dark_logo_filename;
            $website_dark_logo->save();
          }
        }


        if($request->hasFile('website_light_logo')){

          /*--- remove image from folder ---*/
          if(!empty($website_light_logo['key'])){

            $remove_light_logo=public_path().'/storage/logo/'.$website_light_logo['value'];
            unlink($remove_light_logo);

          }
          
          $document_path = 'logo';
          
          if (!\Storage::exists($document_path)) {

            \Storage::makeDirectory($document_path, 0777);
          }
          $light_logo_filename = pathinfo($request->file('website_light_logo')->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'_'.$request->file('website_light_logo')->getClientOriginalExtension();
          $request->file('website_light_logo')->storeAs($document_path, $light_logo_filename);

          if(empty($website_light_logo['key'])){
            $insert = new General;
            $insert->key='website_light_logo';
            $insert->value=$light_logo_filename;
            $insert->save();

          }else{

            $website_light_logo->value=$light_logo_filename;
            $website_light_logo->save();
          }
        }


        if($request->hasFile('website_fevicon_icon')){

          /*--- remove image from folder ---*/
          if(!empty($website_fevicon_icon['key'])){

            $remove_fevicon_icon=public_path().'/storage/logo/'.$website_fevicon_icon['value'];
            unlink($remove_fevicon_icon);

          }
          
          $document_path = 'logo';
          
          if (!\Storage::exists($document_path)) {

            \Storage::makeDirectory($document_path, 0777);
          }
          $fevicon_icon_filename = pathinfo($request->file('website_fevicon_icon')->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'_'.$request->file('website_fevicon_icon')->getClientOriginalExtension();
          $request->file('website_fevicon_icon')->storeAs($document_path, $fevicon_icon_filename);

          if(empty($website_fevicon_icon['key'])){
            $insert = new General;
            $insert->key='website_fevicon_icon';
            $insert->value=$fevicon_icon_filename;
            $insert->save();

          }else{

            $website_fevicon_icon->value=$fevicon_icon_filename;
            $website_fevicon_icon->save();
          }
        }

        return redirect()->route('backend.setting.general')->with(['status'=>'success','message'=>'General setting has updated successfully.']);

      }catch(\Exception $e){

        return redirect()->route('backend.setting.general')->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(General $general)
    {
        //
    }
  }
