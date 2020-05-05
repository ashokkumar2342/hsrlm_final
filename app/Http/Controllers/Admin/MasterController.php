<?php

namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use App\Model\Bank;
use App\Model\BankDetail;
use App\Model\DeliveryClusterMap;
use App\Model\Item;
use App\Model\Measurement;
use App\Model\Order;
use App\Model\RateList;
use App\Model\Transaction;
use App\Model\UserActivity;
use App\Model\UserDetail;
use App\Model\Village;
use App\Model\VillageClusterMap;
use App\Model\VillageFarmerMap;
use App\Model\VillageVenderMap;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

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

    public function villagedelete($id)
    {
        $id =Crypt::decrypt($id);
        $Village =Village::find($id);
        $Village->delete();
        $response=['status'=>1,'msg'=>'Delete Successfully'];
            return response()->json($response);
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
                return response()->json($response);
              }     
        }
     public function itemsImage(Request $request,$image)
     {
        return $itemsImage = Storage::disk('student')->get('itemspicture/picture/'.$image);           
         return  response($itemsImage)->header('Content-Type', 'image/jpg');
     }
     public function itemsDelete($id)
     {
      $id =Crypt::decrypt($id); 
      $Item =Item::find($id);
      $Item->delete();
       return  redirect()->back()->with(['message'=>'Delete Successfully','class'=>'success']);
     }
    //-----------------------------------------rate-list----------------------------------------
    
    public function rateList()
    {   $Items=Item::orderBy('name','ASC')->get();
        $RateLists=RateList::orderBy('purchase_rate','ASC')->get();
        return view('admin.master.ratelist.rate_list',compact('Items','RateLists'));
    }   

    public function rateListPrice(Request $request)
    {
      $rules=[
         'for_date' => 'required',  
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        $Items=Item::orderBy('name','ASC')->get();
        $date=$request->for_date; 
        $clone_previous_rate=$request->clone_previous_rate; 
        return view('admin.master.ratelist.rate_list_table',compact('Items','date','clone_previous_rate'));
    }
    public function rateListPriceFarmer(Request $request)
    {
      $rules=[
         'for_date' => 'required',  
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        $Items=Item::orderBy('name','ASC')->get();
        $date=$request->for_date;  
        return view('admin.master.ratelist.rate_list_farmer_table',compact('Items','date'));
    }
    public function rateListPriceFarmerStore(Request $request)
    {
      $user =Auth::guard('admin')->user();
      $rules=[
         'for_date' => 'required',  
        ]; 
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        foreach ($request->units as $key => $value) {
          if ($value!=0) {
            $orders=new Order();
            $orders->user_id=$user->id;
            $orders->user_type_id=$user->user_type_id;
            $orders->items_id=$key;
            $orders->unit=$value;
            $orders->save();
            $order_id=$orders->id;
            $Transaction= Transaction::firstOrNew(['id'=>$request->transaction_id[$key]]); 
            $Transaction->user_id=$user->id;
            $Transaction->user_type_id=$user->user_type_id;
            $Transaction->for_date=$request->for_date;
            $Transaction->item_id=$key;
            $Transaction->qty=$value;
            $Transaction->rate=$request->rate[$key];
            $Transaction->order_id=$order_id;
            $Transaction->save();
            
          }
          }
          $response=['status'=>1,'msg'=>'Submit Successfully'];
                return response()->json($response);
       
        
    }
    public function rateListPriceStore(Request $request)
    {   $rules=[
             'for_date' => 'required|date', 
             'purchase_rate' => 'required',               
             'sale_rate' => 'required',               
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
                foreach ($request->purchase_rate as $key => $rate) {
                $RateList=RateList::firstOrNew(['for_date'=>$request->for_date,'items_id'=>$key]); 
                $RateList->for_date=$request->for_date;
                $RateList->items_id=$key;
                $RateList->purchase_rate=$rate;
                $RateList->sale_rate=$request->sale_rate[$key]; 
                $RateList->save();
                }
               
                $response=['status'=>1,'msg'=>'Submit Successfully'];
                return response()->json($response);
              }
       
    }

    //end rate list-------------------------------------------------------------  
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
      $coditionId=2;
      $user_id=$request->id;
      $VillageFarmerMap=VillageFarmerMap::where('village_shg_id',$request->id)->pluck('farmer_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId(2);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      $data['coditionId'] = $coditionId;
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
    public function villageFarmerReport($id)
    {
      $coditionId=2;
      $user_id=$id;
      $VillageFarmerMap=VillageFarmerMap::where('village_shg_id',$id)->pluck('farmer_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId(2);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      $data['coditionId'] = $coditionId;
      $pdf = PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.master.mapping.user_mapped',$data);
        return $pdf->stream('village_farmer_report.pdf');
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
    {
      $coditionId=3;
      $user_id=$request->id;
      $VillageFarmerMap=VillageVenderMap::where('village_shg_id',$request->id)->pluck('vender_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId(3);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      $data['coditionId'] = $coditionId;
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
    public function villageVendorReport($id)
    {
      $coditionId=3;
      $user_id=$id;
     $VillageFarmerMap=VillageVenderMap::where('village_shg_id',$id)->pluck('vender_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId(3);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      $data['coditionId'] = $coditionId;
      $pdf = PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.master.mapping.user_mapped',$data);
        return $pdf->stream('village_farmer_report.pdf');
    } 

    //-----------------------------villageCluster--------------------------------------
    public function villageCluster()
    {     
      $user =new User();
      $users =$user->getUserByUserTypeId(5);
      $data=array();
      $data['users'] = $users;
      return view('admin.master.mapping.village_cluster',$data);
    }
    public function villageClusterToUser(Request $request)
    {
      $coditionId=4;
      $user_id=$request->id;
      $VillageFarmerMap=VillageClusterMap::where('cluster_shg_id',$request->id)->pluck('village_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId(4);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      $data['coditionId'] = $coditionId;
      return view('admin.master.mapping.village_cluster_to_user',$data);
    }
    public function villageClusterStore(Request $request)
    { 
      $rules=[
          'user' => 'required',
          'village' => 'required',
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
          $VillageFarmerMapold =VillageClusterMap::where('cluster_shg_id',$request->user)->pluck('id')->toArray();
          $uctOld=VillageClusterMap::whereIn('id',$VillageFarmerMapold)->update(['village_id'=>0]);
          foreach ($request->village as $key => $value) {
           $VillageFarmerMap=VillageClusterMap::firstOrNew(['village_id'=>$value]); 
           $VillageFarmerMap->village_id=$value; 
           $VillageFarmerMap->cluster_shg_id=$request->user; 
           $VillageFarmerMap->save();
          }
          $response=['status'=>1,'msg'=>'Save Successfully'];
        }  
      return $response;
    }
    public function villageClusterReport($id)
    {
      $coditionId=4;
      $user_id=$id;
      $VillageFarmerMap=VillageClusterMap::where('cluster_shg_id',$id)->pluck('village_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId(4);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      $data['coditionId'] = $coditionId;
      $pdf = PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.master.mapping.user_mapped',$data);
        return $pdf->stream('village_farmer_report.pdf');
    } 
    //--------------------------------delivery-Village-----------------------------------
    public function deliveryVillage()
    {     
      $user =new User();
      $users =$user->getUserByUserTypeId(6);
      $data=array();
      $data['users'] = $users;
      return view('admin.master.mapping.village_delivery',$data);
    }
    public function villageDeleveryToUser(Request $request)
    { 
      $coditionId=6;
      $conditionid2=$request->cluster_village_shg;
      $user_id=$request->delivery;
      $VillageFarmerMap=DeliveryClusterMap::where('delivery_id',$request->delivery)->where('user_type_id',$request->cluster_village_shg)->pluck('cluster_village_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId($request->cluster_village_shg);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      $data['coditionId'] = $coditionId;
      $data['conditionid2'] = $conditionid2;
     
      return view('admin.master.mapping.village_delivery_to_user',$data);
    }
    public function villageDeleveryStore(Request $request)
    { 
      $rules=[
          'delivery' => 'required',
          'cluster_village_shg' => 'required',
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

        //--validation--------------------------------
        if ($request->cluster_village_shg==4) {
        if (empty($request->cluster_village_id)) {
          $response=array();
          $response["status"]=0;
          $response["msg"]='The village shg field is required.';
          return response()->json($response);
        }
       }
       if ($request->cluster_village_shg==5) {
        if (empty($request->cluster_village_id)) {
          $response=array();
          $response["status"]=0;
          $response["msg"]='The cluster shg field is required.';
          return response()->json($response);
        }
       }
       //end--validation--------------------------------
          $VillageFarmerMapold =DeliveryClusterMap::where('delivery_id',$request->delivery)->where('user_type_id',$request->cluster_village_shg)->pluck('id')->toArray();
          $uctOld=DeliveryClusterMap::whereIn('id',$VillageFarmerMapold)->update(['cluster_village_id'=>0]);
          foreach ($request->cluster_village_id as $key => $value) {
           $VillageFarmerMap=DeliveryClusterMap::firstOrNew(['cluster_village_id'=>$request->value,'user_type_id'=>$request->cluster_village_shg,'delivery_id'=>$request->delivery]); 
           $VillageFarmerMap->cluster_village_id=$value; 
           $VillageFarmerMap->delivery_id=$request->delivery; 
           $VillageFarmerMap->user_type_id=$request->cluster_village_shg; 
           $VillageFarmerMap->save();
          }
          $response=['status'=>1,'msg'=>'Save Successfully'];
        }  
      return $response;
    }
    public function villageClusterDeleveryReport($id,$vill_clus_shg)
    {
      $coditionId=6;
      $conditionid2 =$vill_clus_shg;
      $user_id=$id;
      $VillageFarmerMap=DeliveryClusterMap::where('delivery_id',$id)->where('user_type_id',$vill_clus_shg)->pluck('cluster_village_id')->toArray(); 
      $user =new User();
      $to_users =$user->getUserByUserTypeId($vill_clus_shg);
      $data=array();
      $data['to_users'] = $to_users;
      $data['VillageFarmerMap'] = $VillageFarmerMap;
      $data['user_id'] = $user_id;
      $data['coditionId'] = $coditionId;
      $data['conditionid2'] = $conditionid2;
      $pdf = PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])
        ->loadView('admin.master.mapping.user_mapped',$data);
        return $pdf->stream('village_farmer_report.pdf');
    } 
    //---------------------user-Bank-Details-----------------------------------
    public function userBankDetails($value='')
    {
      return view('admin.master.bank.user_bank_list');
    }
    public function showBankDetails(Request $request)
    {
      $user=User::where('user_id',$request->user_id)->first();
      $banks=Bank::orderBy('name','ASC')->get();
      $userdetail=UserDetail::where('user_id',$user->id)->first();
      $bankDetail=BankDetail::where('user_id',$user->id)->first();
     if (empty($user)) {
          $response=array();
          $response["status"]=0;
          $response["msg"]='Invalid User Id';
          return response()->json($response);
        }
      return view('admin.master.bank.add_form',compact('user','banks','userdetail','bankDetail'));
    }
    public function storeBankDetails(Request $request,$id=null)
    {
       
       $rules=[
        'user_name' => 'required|max:100|',     
        'gender' => 'required',              
        'bank_name' => 'required',              
        'ifsc_code' => 'required',              
        'account_no' => 'required',              
        'branch' => 'required',              
       
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        } 
        $bankDetails =BankDetail::firstOrNew(['id'=>$id]);
        $bankDetails->user_id = $request->user_id;
        $bankDetails->bank_id = $request->bank_name;
        $bankDetails->ifsc_code = $request->ifsc_code;
        $bankDetails->account_no = $request->account_no;
        $bankDetails->branch = $request->branch;
        $bankDetails->bank_address = $request->bank_address;
        $bankDetails->save();
        $userDetail =UserDetail::firstOrNew(['id'=>$id]);
        $userDetail->user_id = $request->user_id;
        $userDetail->city = $request->city;
        $userDetail->dob = $request->dob == null ? $request->dob : date('Y-m-d',strtotime($request->dob));
        $userDetail->gender = $request->gender;
        $userDetail->city = $request->city;
        $userDetail->c_address = $request->current_address;
        $userDetail->p_address = $request->permanent_address;
        $userDetail->pincode = $request->pincode;
        $userDetail->save();
        $response=['status'=>1,'msg'=>'Submit Successfully'];
            return response()->json($response);   
    }
     
 
}
