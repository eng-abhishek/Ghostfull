<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Mailer;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Setting\MailerSettingRequest;
use DataTables;

class MailersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      if ($request->ajax()) {

        $row = Mailer::orderBy('id','desc')->latest()->get();

        return Datatables::of($row)

        ->addIndexColumn()

        
        ->addColumn('status', function($row){
          if($row->is_active=='Y'){
            $status = '<label class="switch">
            <input type="checkbox" id="updateStatus" data-id="'.$row->id.'" checked class="is_active'.$row->id.'"><span class="slider round"></span></label>';
          }else{
            $status = '<label class="switch">
            <input type="checkbox" id="updateStatus" data-id="'.$row->id.'" class="is_active'.$row->id.'"><span class="slider round"></span></label>';

          }
          return $status;
        })


        ->addColumn('action', function($row){

         $btn = '<span class="dropdown">
         <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="false">
         <i class="la la-ellipsis-h"></i>
         </a>
         <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-32px, 27px, 0px);">
         <a class="dropdown-item" href="'.route('backend.setting.mailers.edit',$row->id).'"><i class="la la-edit"></i> Edit Mailer</a>';

         $btn.='<a class="dropdown-item deleteRecord" href="javascript:void(0)" data-id="'.$row->id.'"><i class="la la-remove"></i> Delete Mailer</a></div>';

         return $btn;
       })

        ->rawColumns(['status','action'])
        ->make(true);
      }
      return view('backend.setting.mailers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('backend.setting.mailers.create');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailerSettingRequest $request)
    {

      try{

        $mailerdata = new Mailer; 
        $mailerdata->driver =$request->driver ;
        $mailerdata->host=$request->host;
        $mailerdata->port=$request->port;
        $mailerdata->encryption=$request->encryption;
        $mailerdata->password=$request->password;
        $mailerdata->from_name=$request->from_name;
        $mailerdata->from_email=$request->from_email;
        $mailerdata->save();

        return redirect()->route('backend.setting.mailers.index')->with(['status'=>'success','message'=>'Mail configuration has added successfully.']);

      }catch(\Exception $e){

        return redirect()->route('backend.setting.mailers.create')->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);
      }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mailers  $mailers
     * @return \Illuminate\Http\Response
     */
    public function show(Mailer $mailers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mailers  $mailers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['mailer']=Mailer::find($id);
      return view('backend.setting.mailers.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mailers  $mailers
     * @return \Illuminate\Http\Response
     */
    public function update(MailerSettingRequest $request, $id)
    {

      try{

        $mailerdata = Mailer::find($id); 
        $mailerdata->driver =$request->driver ;
        $mailerdata->host=$request->host;
        $mailerdata->port=$request->port;
        $mailerdata->encryption=$request->encryption;
        $mailerdata->password=$request->password;
        $mailerdata->from_name=$request->from_name;
        $mailerdata->from_email=$request->from_email;
        $mailerdata->save();

        return redirect()->route('backend.setting.mailers.index')->with(['status'=>'success','message'=>'Mail configuration has updated successfully.']);

      }catch(\Exception $e){

        return redirect()->route('backend.setting.mailers.edit')->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mailers  $mailers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      try{
        $mailerData=Mailer::find($id);

        if(!empty($mailerData->id)){

          $mailerData->delete();
          return response()->json(['status'=>'success','message'=>'Mail configuration has deleted successfully.']);
        }
      }catch(\Exception $e){

       return response()->json(['status'=>'error','message'=>'Oop`s something wents worng.']);
     }

   }

   public function changeStatus(Request $request){

     try{

       $check_is_active=Mailer::where('is_active','Y')->where('id','!=',$request->id)->first();

       if(empty($check_is_active)){

         $mailerData=Mailer::find($request->id);
         $mailerData->is_active=$request->is_active;
         $mailerData->save();
         if($request->is_active=='Y'){

           return response()->json(['status'=>'success','message'=>'Mail configuration has activated successfully.']);    
         }elseif($request->is_active=='N'){

           return response()->json(['status'=>'success','message'=>'Mail configuration has Inactivated successfully.']);
         }

       }else{

         return response()->json(['status'=>'error','message'=>'Oop`s One mail configuration is already active.']);
       }

     }catch(\Exception $e){

      return response()->json(['status'=>'error','message'=>'Oop`s something wents worng.']);
    }

  }

}
