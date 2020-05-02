<?php

namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use App\Model\Item;
use App\Model\Measurement;
use App\Model\RateList;
use App\Model\UserActivity;
use App\Model\Village;
use App\Model\VillageClusterMap;
use App\Model\VillageFarmerMap;
use App\Model\VillageVenderMap;
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

      $measurements =Measurement::get();

      return view('admin.master.items.add_form',compact('Items','measurements'));
    }
    public function storeItems(Request $request,$id=null)
      { 

          $rules=[
             'items_name' => 'required', 
             'measurement' => 'required',               
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
               $Items->measurement_id=$request->measurement;
               if ($request->hasFile('items_picture')) { 
                $attachment=$request->items_picture;
                $filename='items_picture'.date('d-m-Y').time().'.png'; 
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

    public function rateListPrice(Request $request)
    {
        $Items=Item::orderBy('name','ASC')->get();
        $RateLists=RateList::orderBy('purchase_rate','ASC')->get();
        return view('admin.master.ratelist.rate_list_table',compact('Items','RateLists'));
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
    {$user_id=$request->id;
      $VillageFarmerMap=VillageFarmerMap::where('village_shg_id',$request->id)->pluck('farmer_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId(2);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      return view('admin.master.mapping.to_user',$data);
    } 
    public function villageFarmerStore(Request $request)
    { 
      $rules=[
          'farmer_id' => 'required',
          'user' => 'required',
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
          $VillageFarmerMapold =VillageFarmerMap::where('village_shg_id',$request->user)->pluck('id')->toArray();
          $uctOld=VillageFarmerMap::whereIn('id',$VillageFarmerMapold)->update(['farmer_id'=>0]);
          foreach ($request->farmer_id as $key => $value) {
           $VillageFarmerMap=VillageFarmerMap::firstOrNew(['farmer_id'=>$value]); 
           $VillageFarmerMap->farmer_id=$value; 
           $VillageFarmerMap->village_shg_id=$request->user; 
           $VillageFarmerMap->save();
          }
          $response=['status'=>1,'msg'=>'Save Successfully'];
        }  
      return $response;
    } 

    //-------------------------------village-Vendor------------------------------------------
    public function villageVendor()
    {     
      $user =new User();
      $users =$user->getUserByUserTypeId(4);
      $data=array();
      $data['users'] = $users;
      return view('admin.master.mapping.village_vendor',$data);
    }
    public function villageVendorToUser(Request $request)
    {$user_id=$request->id;
      $VillageFarmerMap=VillageVenderMap::where('village_shg_id',$request->id)->pluck('vender_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId(3);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      return view('admin.master.mapping.village_vendor_to_user',$data);
    }
    public function villageVendorStore(Request $request)
    { 
      $rules=[
          'user' => 'required',
          'vendor' => 'required',
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
          $VillageFarmerMapold =VillageVenderMap::where('village_shg_id',$request->user)->pluck('id')->toArray();
          $uctOld=VillageVenderMap::whereIn('id',$VillageFarmerMapold)->update(['vender_id'=>0]);
          foreach ($request->vendor as $key => $value) {
           $VillageFarmerMap=VillageVenderMap::firstOrNew(['vender_id'=>$value]); 
           $VillageFarmerMap->vender_id=$value; 
           $VillageFarmerMap->village_shg_id=$request->user; 
           $VillageFarmerMap->save();
          }
          $response=['status'=>1,'msg'=>'Save Successfully'];
        }  
      return $response;
    }

    //-----------------------------villageCluster--------------------------------------
    public function villageCluster()
    {     
      $user =new User();
      $users =$user->getUserByUserTypeId(4);
      $data=array();
      $data['users'] = $users;
      return view('admin.master.mapping.village_cluster',$data);
    }
    public function villageClusterToUser(Request $request)
    {$user_id=$request->id;
      $VillageFarmerMap=VillageClusterMap::where('village_shg_id',$request->id)->pluck('cluster_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId(5);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      return view('admin.master.mapping.village_cluster_to_user',$data);
    }
    public function villageClusterStore(Request $request)
    { 
      $rules=[
          'user' => 'required',
          'cluster' => 'required',
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
          $VillageFarmerMapold =VillageClusterMap::where('village_shg_id',$request->user)->pluck('id')->toArray();
          $uctOld=VillageClusterMap::whereIn('id',$VillageFarmerMapold)->update(['cluster_id'=>0]);
          foreach ($request->cluster as $key => $value) {
           $VillageFarmerMap=VillageClusterMap::firstOrNew(['cluster_id'=>$value]); 
           $VillageFarmerMap->cluster_id=$value; 
           $VillageFarmerMap->village_shg_id=$request->user; 
           $VillageFarmerMap->save();
          }
          $response=['status'=>1,'msg'=>'Save Successfully'];
        }  
      return $response;
    }   

}
