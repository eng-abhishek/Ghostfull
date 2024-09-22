<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\CouponRequest;
use DataTables;
use Carbon\Carbon;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $row = Coupon::orderBy('id','desc')->latest()->get();

            return Datatables::of($row)

            ->addIndexColumn()

            ->addColumn('action', function($row){

             $btn = '<span class="dropdown">
             <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="false">
             <i class="la la-ellipsis-h"></i>
             </a>
             <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-32px, 27px, 0px);">
             <a class="dropdown-item" href="'.route('backend.coupon.edit',$row->id).'"><i class="la la-edit"></i> Edit Coupon</a>';

             $btn.='<a class="dropdown-item deleteRecord" href="javascript:void(0)" data-id="'.$row->id.'"><i class="la la-remove"></i> Delete Coupon</a></div>';

             return $btn;
         })

            ->addColumn('expiry', function($row){
             $expiry = Carbon::parse($row->end_date)->format('d-m-Y h-i A');
             return $expiry;
         })

            ->rawColumns(['expiry','action'])
            ->make(true);
        }
        return view('backend.coupon.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data['plan'] = Plan::all();
      return view('backend.coupon.create',$data);
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {

        try{
          
             /*---- check date condition ----*/
        if ((Carbon::parse($request->start_date) > Carbon::parse($request->end_date) )) {

            return redirect()->route('backend.coupon.create')->withInput($request->input())->with(['status'=>'danger','message'=>'Oop`s Invalid end date.'])->withInput();
        }

            /*---- check free plan condition ----*/
        $check_free_plane=Plan::where(['id'=>$request->plan_id,'is_free_plan'=>'Y'])->first();

        if(!empty($check_free_plane->id)){

            return redirect()->route('backend.coupon.create')->withInput($request->input())->with(['status'=>'danger','message'=>'Oop`s Coupon can`t generate for free plan.'])->withInput();

        }   
             /*---- check percentage condition ----*/
        if($request->discount_type=='percentage'){

            if ($request->discount_amount < 1 || $request->discount_amount > 100) {

                return redirect()->route('backend.coupon.create')->with(['status'=>'danger','message'=>'Oop`s Invalid discount percentage.'])->withInput();
            }
        }

        $couponData = new Coupon; 
        $couponData->name = $request->name;
        $couponData->code = strtoupper($request->code);
        $couponData->plan_id = ($request->plan_id=='all') ? null : $request->plan_id;
        $couponData->description = $request->description;
        $couponData->discount_type = $request->discount_type;
        $couponData->discount_amount = $request->discount_amount;
        $couponData->limit_per_user = $request->limit_per_user;
        $couponData->start_date = Carbon::parse($request->start_date);
        $couponData->end_date = Carbon::parse($request->end_date);
        $couponData->save();

        return redirect()->route('backend.coupon.index')->withInput($request->input())->with(['status'=>'success','message'=>'Coupon has added successfully.']);

    }catch(\Exception $e){

       return redirect()->route('backend.coupon.create')->withInput($request->input())->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);
   }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['coupon'] = Coupon::where('id',$id)->first(); 
      $data['plan'] = Plan::all();
      $data['start_date'] = Carbon::parse($data['coupon']->start_date)->format('d-m-Y h:i');
      $data['end_date'] = Carbon::parse($data['coupon']->end_date)->format('d-m-Y h:i');
      return view('backend.coupon.edit',$data);
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        
        try{

             /*---- check date condition ----*/
            if ((Carbon::parse($request->start_date) > Carbon::parse($request->end_date) )) {

                return redirect()->route('backend.coupon.edit',$id)->with(['status'=>'danger','message'=>'Oop`s Invalid end date.'])->withInput();
            }
            
             /*---- check free plan condition ----*/
            $check_free_plane=Plan::where(['id'=>$request->plan_id,'is_free_plan'=>'Y'])->first();

            if(!empty($check_free_plane->id)){

                return redirect()->route('backend.coupon.edit',$id)->withInput($request->input())->with(['status'=>'danger','message'=>'Oop`s Coupon can`t generate for free plan.'])->withInput();

            }

             /*---- check percentage condition ----*/
            if($request->discount_type=='percentage'){

                if ($request->discount_amount < 1 || $request->discount_amount > 100) {

                    return redirect()->route('backend.coupon.edit',$id)->with(['status'=>'danger','message'=>'Oop`s Invalid discount percentage.'])->withInput();
                }
            }

            $couponData = Coupon::where('id',$id)->first();
            $couponData->name = $request->name;
            $couponData->code = strtoupper($request->code);
            $couponData->plan_id = ($request->plan_id=='all') ? null : $request->plan_id;
            $couponData->description = $request->description;
            $couponData->discount_type = $request->discount_type;
            $couponData->discount_amount = $request->discount_amount;
            $couponData->limit_per_user = $request->limit_per_user;
            $couponData->start_date = Carbon::parse($request->start_date);
            $couponData->end_date = Carbon::parse($request->end_date);
            $couponData->save();

            return redirect()->route('backend.coupon.index')->with(['status'=>'success','message'=>'Coupon has updated successfully.']);

        }catch(\Exception $e){

         return redirect()->route('backend.coupon.edit',$id)->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);
     }
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $couponData = Coupon::find($id);
            if(!empty($couponData->id)){

                $couponData->delete();
                return response()->json(['status'=>'success','message'=>'Coupon has deleted successfully.']);
            }
        }catch(\Exception $e){

            return response()->json(['status'=>'error','message'=>'Oop`s something wents worng.']);
        }
    }
}
