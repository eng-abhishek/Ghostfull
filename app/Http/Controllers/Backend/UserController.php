<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\UserRequest;
use App\Models\User;
use App\Models\Country;
use DataTables;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            if(!empty($request->get('status'))){
                $row = User::where('is_admin','N')->where('is_active',$request->get('status'))->latest()->get();
                
            }else{
                $row = User::where('is_admin','N')->latest()->get();
                
            }
            
            return Datatables::of($row)

            ->addIndexColumn()

            ->addColumn('image', function($row){

                $img = '<img src="'.$row->avatar_url.'" alt="'.$row->avatar.'" class="listImg">';

                return $img;
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
               <a class="dropdown-item" href="'.route('backend.users.edit',$row->id).'"><i class="la la-edit"></i> Edit User</a>';

               $btn.='<a class="dropdown-item deleteRecord" href="javascript:void(0)" data-id="'.$row->id.'"><i class="la la-remove"></i> Delete User</a></div>';

               return $btn;
           })

            ->rawColumns(['image','status','action'])
            ->make(true);
        }
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['country']=Country::all();
        return view('backend.users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try{

            $address = [
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
                'country' => $request->country,
            ];

            $udata = new User; 
            $udata->firstname=$request->firstname;
            $udata->lastname=$request->lastname;
            $udata->username=$request->username;
            $udata->email=$request->email;
            $udata->address=json_encode($address);
            $udata->phone_number=$request->phone_number;
            $udata->password=Hash::make($request->password);
            $udata->save();

            return redirect()->route('backend.users.index')->with(['status'=>'success','message'=>'User has added successfully.']);

        }catch(\Exception $e){

          return redirect()->route('backend.users.index')->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['userData']=User::find($id);
        $data['address']=json_decode($data['userData']->address);
        $data['country']=Country::all();

        return view('backend.users.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
       try{

        $address = [
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'country' => $request->country,
        ];

        $udata=User::find($id);
        $udata->firstname=$request->firstname;
        $udata->lastname=$request->lastname;
        $udata->username=$request->username;
        $udata->email=$request->email;
        $udata->address=json_encode($address);
        $udata->phone_number=$request->phone_number;
        if(!empty($request->password)){
            $udata->password=Hash::make($request->password);
        }
        $udata->save();

        return redirect()->route('backend.users.index')->with(['status'=>'success','message'=>'User has updated successfully.']);

    }catch(\Exception $e){

        return redirect()->route('backend.users.index')->with(['status'=>'danger','message'=>'Oop`s something wents worng.']);
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
            $userData=User::find($id);
            if(!empty($userData->id)){

             $avatar = $userData->avatar;
             /*--- remove image from folder ---*/
             if(!empty($avatar)){

                $removeImg = public_path().'/storage/avatars/'.$avatar;
                unlink($removeImg);
            }
            $userData->delete();
            return response()->json(['status'=>'success','message'=>'User has deleted successfully.']);
        }
    }catch(\Exception $e){

     return response()->json(['status'=>'error','message'=>'Oop`s something wents worng.']);
 }
}
/*------ change status -----*/
public function changeStatus(Request $request){
   
   try{
       $uData=User::find($request->id);
       $uData->is_active=$request->is_active;
       $uData->save();
       if($request->is_active=='Y'){

           return response()->json(['status'=>'success','message'=>'User has activated successfully..']);    
       }elseif($request->is_active=='N'){
           
           return response()->json(['status'=>'success','message'=>'User has Inactivated successfully.']);
       }
       
   }catch(\Exception $e){
       
    return response()->json(['status'=>'error','message'=>'Oop`s something wents worng.']);
}
}

}
