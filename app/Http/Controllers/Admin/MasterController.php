<?php

namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use App\Model\Item;
use App\Model\RateList;
use App\Model\UserActivity;
use App\Model\Village;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function villageList()
    {
        return view('admin.master.village.village_list');
    }
    public function villageListTable()
    {
        $Villages =Village::orderBy('name','ASC')->get();
        return view('admin.master.village.village_list_table',compact('Villages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addVillage($id=null)
    {
        if ($id==null) {
           $Villages='';  
        }
        if ($id!=null) {
           $Villages='';  
           $Villages =Village::find(Crypt::decrypt($id));
        }
        return view('admin.master.village.add_village',compact('Villages'));
    }

    Public function villageStore(Request $request,$id=null){
        $rules=[
        'village_name' => 'required|max:100|unique:village,name,'.$id,     
        'village_code' => 'required|max:5|unique:village,code,'.$id,              
       
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        } 
        $Villages =Village::firstOrNew(['id'=>$id]);
        $Villages->name = $request->village_name;
        $Villages->code = $request->village_code;
        $Villages->save(); 
        $response=['status'=>1,'msg'=>'Submit Successfully'];
            return response()->json($response);   
    }

    public function destroy(UserActivity $userActivity)
    {
        //
    }

    //------------------------------items-----------------------------------------

     public function itemsList()
    {
        $Items=Item::orderBy('name','ASC')->get();
        return view('admin.master.items.items_list',compact('Items'));
    }
    public function addItems($id=null)
    {
      if ($id==null) {
        $Items='';
      }
      if ($id!=null) {
        $Items=Item::find(Crypt::decrypt($id));
      }

        return view('admin.master.items.add_form',compact('Items'));
    }
    public function storeItems(Request $request,$id=null)
      { 

          $rules=[
             'items_name' => 'required', 
            ];

            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $response=array();
                $response["status"]=0;
                $response["msg"]=$errors[0];
                return response()->json($response);// response as json
            }
              else {
               $Items=Item::firstOrNew(['id'=>$id]);  
               $Items->name=$request->items_name;
               if ($request->hasFile('items_picture')) { 
                $attachment=$request->items_picture;
                $filename='items_picture'.date('d-m-Y').time().'.pdf'; 
                $attachment->storeAs('student/itemspicture/picture/',$filename);
                $Items->picture=$filename;
                } 
                $Items->save();
                $response=['status'=>1,'msg'=>'Submit Successfully'];
              }     return response()->json($response);
        }
     public function itemsImage(Request $request,$image)
     {
        return $itemsImage = Storage::disk('student')->get('itemspicture/picture/'.$image);           
         return  response($itemsImage)->header('Content-Type', 'image/jpg');
     }
    //-----------------------------------------rate-list----------------------------------------
    
    public function rateList()
    {   $Items=Item::orderBy('name','ASC')->get();
        $RateLists=RateList::orderBy('purchase_rate','ASC')->get();
        return view('admin.master.ratelist.rate_list',compact('Items','RateLists'));
    }   
      
    public function villageFarmer()
    {     
      $user =new User();
      $users =$user->getUserByUserTypeId(4);
      $data=array();
      $data['users'] = $users;
      return view('admin.master.mapping.village_farmer',$data);
    }
    public function villageFarmerToUser(Request $request)
    {  
      $user =new User();
      $to_users =$user->getUserByUserTypeId(2);
      $data=array();
      $data['to_users'] = $to_users;
      return view('admin.master.mapping.to_user',$data);
    } 
    public function villageFarmerStore(Request $request)
    { 
      $rules=[
          'farmer_id' => 'required',
        ];

      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
          $errors = $validator->errors()->all();
          $response=array();
          $response["status"]=0;
          $response["msg"]=$errors[0];
          return response()->json($response);// response as json
      }
        else {
         $adminssionSeat=AdmissionSeat::firstOrNew(['id'=>$id]);  
          
         $adminssionSeat->save();
          $response=['status'=>1,'msg'=>'Save Successfully'];
        }  
      
      return $response;
    }    


}
