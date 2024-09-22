<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\StorageProvider;
use Illuminate\Http\Request;
use DataTables;

class StorageProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->ajax()) {

        $row = StorageProvider::orderBy('id','desc')->latest()->get();

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


        ->addColumn('action', function($row){

         $btn = '<span class="dropdown">
         <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="false">
         <i class="la la-ellipsis-h"></i>
         </a>
         <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-32px, 27px, 0px);">
         <a class="dropdown-item" href="'.route('backend.setting.storage-provider.edit',$row->id).'"><i class="la la-edit"></i> Edit Storage</a>';

         return $btn;
     })

        ->rawColumns(['status','action','updated_at'])
        ->make(true);
    }
    return view('backend.setting.storage_provider.index');
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
     * @param  \App\StorageProvider  $storageProvider
     * @return \Illuminate\Http\Response
     */
    public function show(StorageProvider $storageProvider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StorageProvider  $storageProvider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['storage']=StorageProvider::find($id);
        return view('backend.setting.storage_provider.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StorageProvider  $storageProvider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
     try{
      
        $provider=StorageProvider::find($id);
        $provider->name=$request->name;
        $provider->credentials=$request->credentials;
        $provider->save();

        return redirect()->route('backend.setting.storage-provider.index')->with(['status'=>'success','message'=>'Storage has updated successfully.']);

    }catch(\Exception $e){

        return redirect()->route('backend.setting.storage-provider.edit',$id)->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);

    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StorageProvider  $storageProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy(StorageProvider $storageProvider)
    {
        //
    }

     /*------ change status -----*/
    public function changeStatus(Request $request){

        try{

            $check_is_active=StorageProvider::where('is_active','Y')->where('id','!=',$request->id)->first();

            if(empty($check_is_active)){

                $mailerData=StorageProvider::find($request->id);
                $mailerData->is_active=$request->is_active;
                $mailerData->save();
                if($request->is_active=='Y'){

                    return response()->json(['status'=>'success','message'=>'Storage has activated successfully.']);    
                }elseif($request->is_active=='N'){

                    return response()->json(['status'=>'success','message'=>'Storage has Inactivated successfully.']);
                }

            }else{

                return response()->json(['status'=>'error','message'=>'Oop`s One Storage is already active.']);
            }

        }catch(\Exception $e){

            return response()->json(['status'=>'error','message'=>'Oop`s something wents worng.']);
        }

    }

}
