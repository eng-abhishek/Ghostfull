<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Upload;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Setting\UploadsRequest;
use DataTables;
use Config;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {

      if ($request->ajax()) {

        $row = Upload::orderBy('id','desc')->latest()->get();

        return Datatables::of($row)

        ->addIndexColumn()

        ->addColumn('updated_at', function($row){

          $updatedDate=date('d-m-Y h:i A',strtotime($row->updated_at));
          return $updatedDate;
        })

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

        ->addColumn('storage_space', function($row){

          $storage_space=($row->storage_space) ? (int)($row->storage_space/Config::get('constants.ONEMEGA')).' '.'MB' : 'Unlimited';
          return $storage_space;
        }) 


        ->addColumn('size_per_file', function($row){

          $size_per_file=($row->size_per_file) ? (int)($row->size_per_file/Config::get('constants.ONEMEGA')).' '.'MB' : 'Unlimited';
          return $size_per_file;
        }) 

        ->addColumn('upload_at_once', function($row){

          $upload_at_once= ($row->upload_at_once>1) ? $row->upload_at_once.' '.'files' : $row->upload_at_once.' '.'file';
          return $upload_at_once;
        })
        
        ->addColumn('file_expired_in', function($row){

          $file_expired_in= ($row->file_expired_in) ? ($row->file_expired_in>1) ? $row->file_expired_in.' '.'days' : $row->file_expired_in.' '.'day' : 'Unlimited';
          return $file_expired_in;
        })

        ->addColumn('password_protection', function($row){

         if($row->password_protection=='Y'){

           $password_protection = '<span class="m-badge  m-badge--primary m-badge--wide">Active</span>';
         }else{

           $password_protection = '<span class="m-badge  m-badge--danger m-badge--wide">Inactive</span>';
         }

         return $password_protection;
       })

        ->addColumn('advertisements', function($row){

         if($row->advertisements=='Y'){

           $advertisements = '<span class="m-badge  m-badge--primary m-badge--wide">Active</span>';
         }else{

           $advertisements = '<span class="m-badge  m-badge--danger m-badge--wide">Inactive</span>';
         }

         return $advertisements;
       })

        ->addColumn('action', function($row){

         $btn = '<span class="dropdown">
         <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="false">
         <i class="la la-ellipsis-h"></i>
         </a>
         <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-32px, 27px, 0px);">
         <a class="dropdown-item" href="'.route('backend.setting.uploads.edit',$row->id).'"><i class="la la-edit"></i> Edit Uploads</a>';
         return $btn;
       })

        ->rawColumns(['upload_at_once','password_protection','advertisements','status','file_expired_in','size_per_file','storage_space','updated_at','action'])
        ->make(true);
      }
      return view('backend.setting.uploads.index');
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
     * @param  \App\Uploads  $uploads
     * @return \Illuminate\Http\Response
     */
    public function show(Uploads $uploads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Uploads  $uploads
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['uploads']=Upload::find($id);

      $data['storage_space']=($data['uploads']->storage_space) ? (int)($data['uploads']->storage_space/Config::get('constants.ONEMEGA')) : '';

      $data['size_per_file']=($data['uploads']->size_per_file) ? (int)($data['uploads']->size_per_file/Config::get('constants.ONEMEGA')) : '';

      return view('backend.setting.uploads.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Uploads  $uploads
     * @return \Illuminate\Http\Response
     */
    public function update(UploadsRequest $request,  $id)
    {

      try{
        
        $uploadsData=Upload::find($id);
        $uploadsData->name=$request->name;
        $uploadsData->password_protection= ($request->password_protection) ? 'Y' : 'N';

        $uploadsData->advertisements= ($request->advertisements) ? 'Y' : 'N';

        $uploadsData->storage_space =($request->storage_space * Config::get('constants.ONEMEGA'));

        $uploadsData->size_per_file=($request->size_per_file  * Config::get('constants.ONEMEGA'));

        $uploadsData->file_expired_in =$request->file_expired_in;

        $uploadsData->upload_at_once=$request->upload_at_once;
        
        $uploadsData->save();

        return redirect()->route('backend.setting.uploads.index')->with(['status'=>'success','message'=>'Uploads has updated successfully.']);

      }catch(\Exception $e){

        return redirect()->route('backend.setting.uploads.edit',$id)->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Uploads  $uploads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upload $uploads)
    {
        //
    }

     /*------ change status -----*/
    public function changeStatus(Request $request){

      try{
       $storageData=Upload::find($request->id);
       $storageData->is_active=$request->is_active;
       $storageData->save();
       if($request->is_active=='Y'){

         return response()->json(['status'=>'success','message'=>'Uploads has activated successfully..']);    
       }elseif($request->is_active=='N'){
         
         return response()->json(['status'=>'success','message'=>'Uploads has Inactivated successfully.']);
       }
       
     }catch(\Exception $e){
       
      return response()->json(['status'=>'error','message'=>'Oop`s something wents worng.']);
    }
  }

}
