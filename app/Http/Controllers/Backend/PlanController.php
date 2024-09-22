<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\PlanRequest;
use App\Models\Plan;
use DataTables;
use Illuminate\Support\Str;
use Config;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       if ($request->ajax()) {

        $row = Plan::orderBy('id','desc')->latest()->get();

        return Datatables::of($row)

        ->addIndexColumn()

        ->addColumn('created_at', function($row){

          $createdDate=date('d-m-Y h:i A',strtotime($row->created_at));
          return $createdDate;
      })


        ->addColumn('storage_space', function($row){

          $storage_space=($row->storage_space) ? (int)($row->storage_space/Config::get('constants.ONEMEGA')).' '.'MB' : 'Unlimited';
          return $storage_space;
      }) 


        ->addColumn('size_per_file', function($row){

          $size_per_file=($row->size_per_file) ? (int)($row->size_per_file/Config::get('constants.ONEMEGA')).' '.'MB' : 'Unlimited';
          return $size_per_file;
      }) 

        ->addColumn('file_expired_in', function($row){

          $file_expired_in= ($row->file_expired_in) ? ($row->file_expired_in>1) ? $row->file_expired_in.' '.'days' : $row->file_expired_in.' '.'day' : 'Unlimited';
          return $file_expired_in;
      }) 

        ->addColumn('price',function($row){

            $price=($row->is_free_plan=='Y') ? "Free" : '<i class="'.Config::get('constants.CURRENCY').'" >'.$row->price ;
            return $price;

        })

        ->addColumn('action', function($row){

           $btn = '<span class="dropdown">
           <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="false">
           <i class="la la-ellipsis-h"></i>
           </a>
           <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-32px, 27px, 0px);">
           <a class="dropdown-item" href="'.route('backend.plan.edit',$row->id).'"><i class="la la-edit"></i> Edit Plan</a>';

           $btn.='<a class="dropdown-item deleteRecord" href="javascript:void(0)" data-id="'.$row->id.'"><i class="la la-remove"></i> Delete Plan</a></div>';

           return $btn;
       })

        ->rawColumns(['size_per_file','storage_space','price','created_at','action'])
        ->make(true);
    }
    return view('backend.plan.index');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.plan.create');
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {

       try{

        if($request->is_featured_plan){
            $check_id=Plan::where('is_featured_plan','Y')->first();
            if(!empty($check_id->id)){
                return redirect()->route('backend.plan.create')->withInput($request->input())->with(['status'=>'danger','message'=>'Featured plane is already occupied with another plane.']);
            }
        }

        if($request->is_free_plan){
            $check_free_id=Plan::where('is_free_plan','Y')->first();
            if(!empty($check_free_id->id)){
                return redirect()->route('backend.plan.create')->withInput($request->input())->with(['status'=>'danger','message'=>'Free plane is already occupied with another plane.']);
            }
        }


        if(empty($request->is_unlimitem_storage) || (empty($request->is_unlimitem_storage) AND !empty($request->is_unlimitem_storage)) ){
            if ( ($request->size_per_file > $request->storage_space) || !($request->size_per_file)) {
                return redirect()->route('backend.plan.create')->withInput($request->input())->with(['status'=>'danger','message'=>'Size of each file cannot be more than storage space.']);
            }
        }


        $planData = new Plan; 
        $planData->name=$request->name;

        $planData->short_description=$request->short_description;
        $planData->interval =$request->interval;
        $planData->slug =Str::slug($request->slug);

        $planData->is_featured_plan=($request->is_featured_plan) ? 'Y' : 'N';

        if(!empty($request->is_free_plan)){

            $planData->price = 0.00;
            $planData->is_free_plan = 'Y';
            $planData->is_login_required = ($request->is_login_required) ? 'Y' : 'N';

        }else{

            $planData->price=$request->price;
        }


        $planData->password_protection= ($request->password_protection) ? 'Y' : 'N';

        $planData->advertisements= ($request->advertisements) ? 'Y' : 'N';


        $planData->storage_space =($request->is_unlimitem_storage) ? null : ($request->storage_space * Config::get('constants.ONEMEGA'));


        $planData->size_per_file=($request->is_unlimitem_file_size) ? null :($request->size_per_file  * Config::get('constants.ONEMEGA'));


        $planData->file_expired_in =($request->is_unlimitem_duration) ? null : $request->file_expired_in;


        $planData->upload_at_once=$request->upload_at_once;
        $planData->other_features=($request->other_features) ? json_encode($request->other_features) : NULL;
        $planData->save();

        return redirect()->route('backend.plan.index')->with(['status'=>'success','message'=>'Plan has added successfully.']);

    }catch(\Exception $e){

        return redirect()->route('backend.plan.create')->withInput($request->input())->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);
    }
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['planData'] = Plan::find($id);
      $data['planOtherFeature']=json_decode($data['planData']->other_features);
      $data['storage_space']=($data['planData']->storage_space) ? (int)($data['planData']->storage_space/Config::get('constants.ONEMEGA')) : '';

      $data['size_per_file']=($data['planData']->size_per_file) ? (int)($data['planData']->size_per_file/Config::get('constants.ONEMEGA')) : '';
      return view('backend.plan.edit',$data);
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, $id)
    {
       try{

        if($request->is_featured_plan){
            $check_id=Plan::where(['is_featured_plan'=>'Y'])->where('id','!=',$id)->first();
            if(!empty($check_id->id)){
                return redirect()->route('backend.plan.edit',$id)->with(['status'=>'danger','message'=>'Featured plane is already occupied with another plane.']);
            }
        }

        if($request->is_free_plan){
            $check_free_id=Plan::where(['is_free_plan'=>'Y'])->where('id','!=',$id)->first();
            if(!empty($check_free_id->id)){
                return redirect()->route('backend.plan.edit',$id)->with(['status'=>'danger','message'=>'Free plane is already occupied with another plane.']);
            }
        }

        if(empty($request->is_unlimitem_storage) || (empty($request->is_unlimitem_storage) AND !empty($request->is_unlimitem_storage)) ){
            if ( ($request->size_per_file > $request->storage_space) || !($request->size_per_file)) {
                return redirect()->route('backend.plan.edit',$id)->with(['status'=>'danger','message'=>'Size of each file cannot be more than storage space.']);
            }

        }


        $planData = Plan::find($id); 
        $planData->name=$request->name;

        $planData->short_description=$request->short_description;
        $planData->interval =$request->interval;
        $planData->slug = Str::slug($request->slug);
        $planData->is_featured_plan=($request->is_featured_plan) ? 'Y' : 'N';

        if(!empty($request->is_free_plan)){

            $planData->price = 0.00;
            $planData->is_free_plan = 'Y';
            $planData->is_login_required = ($request->is_login_required) ? 'Y' : 'N';

        }else{

            $planData->is_login_required='N';
            $planData->is_free_plan = 'N';
            $planData->price=$request->price;
        }

        $planData->password_protection= ($request->password_protection) ? 'Y' : 'N';

        $planData->advertisements= ($request->advertisements) ? 'Y' : 'N';

        $planData->storage_space =($request->is_unlimitem_storage) ? null : ($request->storage_space * Config::get('constants.ONEMEGA'));


        $planData->size_per_file=($request->is_unlimitem_file_size) ? null :($request->size_per_file  * Config::get('constants.ONEMEGA'));


        $planData->file_expired_in =($request->is_unlimitem_duration) ? null : $request->file_expired_in;


        $planData->upload_at_once=$request->upload_at_once;
        $planData->other_features=($request->other_features) ? json_encode($request->other_features) : NULL;

        $planData->save();

        return redirect()->route('backend.plan.index')->with(['status'=>'success','message'=>'Plan has updated successfully.']);

    }catch(\Exception $e){

        return redirect()->route('backend.plan.edit',$id)->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

     try{
        $planData=Plan::find($id);
        if(!empty($planData->id)){

            $planData->delete();
            return response()->json(['status'=>'success','message'=>'Plan has deleted successfully.']);
        }
    }catch(\Exception $e){

     return response()->json(['status'=>'error','message'=>'Oop`s something wents worng.']);
 }
}
}
