<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Str;
use App\Http\Requests\Backend\Setting\PaymentGatewayRequest;

class PaymentGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if ($request->ajax()) {

        $row = PaymentGateway::orderBy('id','desc')->latest()->get();

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

        ->addColumn('logo',function($row){
            if(empty($row->logo)){
               $img=asset('assets/backend/images/default-avatar.jpg');

               $logo='<img class="logo" src="'.$img.'" id="logo">';
               
           }else{
               
               $img=asset("storage/gateway_logo/".$row->logo);

               $logo='<img class="logo" src="'.$img.'" id="logo">';

           }
           return $logo; 
       })

        ->addColumn('action', function($row){

         $btn = '<span class="dropdown">
         <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="false">
         <i class="la la-ellipsis-h"></i>
         </a>
         <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-32px, 27px, 0px);">
         <a class="dropdown-item" href="'.route('backend.setting.payment-gateway.edit',$row->id).'"><i class="la la-edit"></i>Edit Gateway</a>';

         return $btn;
     })

        ->rawColumns(['logo','status','action','updated_at'])
        ->make(true);
    }
    return view('backend.setting.payment_gateway.index');
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
     * @param  \App\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentGateway $paymentGateway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['gateway']=PaymentGateway::find($id);
        return view('backend.setting.payment_gateway.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentGatewayRequest $request,  $id)
    {
     try{
      
        $geteway=PaymentGateway::find($id);
        
        $geteway->name=$request->name;
        
        if($request->hasFile('logo')){

          /*--- remove image from folder ---*/
          if(!empty($geteway->logo)){

            $remove_dark_logo=public_path().'/storage/gateway_logo/'.$geteway->logo;
            unlink($remove_dark_logo);
        }
        
        $document_path = 'gateway_logo';
        
        if (!\Storage::exists($document_path)) {

            \Storage::makeDirectory($document_path, 0777);
        }
        $logo_filename = pathinfo($request->file('logo')->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'_'.$request->file('logo')->getClientOriginalExtension();
        $request->file('logo')->storeAs($document_path, $logo_filename);

        $geteway->logo=$logo_filename;
        
    }
    
    $geteway->credentials=$request->credentials;
    $geteway->fees=$request->fees;
    $geteway->min=$request->min;
    $geteway->save();

    return redirect()->route('backend.setting.payment-gateway.index')->with(['status'=>'success','message'=>'Storage has updated successfully.']);

}catch(\Exception $e){

    return redirect()->route('backend.setting.payment-gateway.edit',$id)->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);

}
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentGateway $paymentGateway)
    {
        //
    }

     /*------ change status -----*/
    public function changeStatus(Request $request){

        try{

            $check_is_active=PaymentGateway::where('is_active','Y')->where('id','!=',$request->id)->first();

            if(empty($check_is_active)){

                $mailerData=PaymentGateway::find($request->id);
                $mailerData->is_active=$request->is_active;
                $mailerData->save();
                if($request->is_active=='Y'){

                    return response()->json(['status'=>'success','message'=>'Payment Gateway has activated successfully.']);    
                }elseif($request->is_active=='N'){

                    return response()->json(['status'=>'success','message'=>'Payment Gateway has Inactivated successfully.']);
                }

            }else{

                return response()->json(['status'=>'error','message'=>'Oop`s One Payment Gateway is already active.']);
            }

        }catch(\Exception $e){

            return response()->json(['status'=>'error','message'=>'Oop`s something wents worng.']);
        }

    }
}
