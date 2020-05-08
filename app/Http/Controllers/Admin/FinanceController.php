<?php

namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use App\Model\DeliveryClusterMap;
use App\Model\Passbook;
use App\Model\Receipt;
use App\Model\VillageFarmerMap;
use App\Model\VillageVenderMap;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

class FinanceController extends Controller
{
     public function index()
     {
        
     	return view('admin.delivery.finance.index');
     } 
     // public function passbookTable(Request $reqeust)
     // {
     //    $user =Auth::guard('admin')->user();
     //    $passbooks =Passbook::where('for_date',$reqeust->for_date)->where('user_id',$user->id)->get();
     //    $data =array();
     //    $data['passbooks'] =$passbooks;
     //    return view('admin.passbook.passbook_table',$data);
     // }
     public function userList($user_type_id)
     {
        $user =Auth::guard('admin')->user(); 
        $cluster_village_id =DeliveryClusterMap::where('delivery_id',$user->id)->where('user_type_id',4)->pluck('cluster_village_id')->toArray();
        if ($user_type_id==3) {
        $village_shg_id =VillageVenderMap::whereIn('village_shg_id',$cluster_village_id)->pluck('vender_id')->toArray();            
        }elseif($user_type_id==2){
         $village_shg_id =VillageFarmerMap::whereIn('village_shg_id',$cluster_village_id)->pluck('farmer_id')->toArray(); 
        }

      $users=User::whereIn('id',$village_shg_id)->get();
        
        return view('admin.delivery.finance.user_list',compact('users','user_type_id')); 
     }
    public function userListPayment($user_id,$user_type_id)
     { 
        return view('admin.delivery.finance.payment_form',compact('user_id','user_type_id')); 
     }
     public function userListPaymentStore(Request $request,$user_id,$user_type_id)
     { 
        $rules=[
            'amount' => 'required',
            'transaction_type' => 'required',
          ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $response=array();
            $response["status"]=0;
            $response["msg"]=$errors[0];
            return response()->json($response);// response as json
        }
        $user =Auth::guard('admin')->user();
        $passbook =new Passbook(); 
        $passbook->user_id=$user_id; 
        $passbook->on_date=date('Y-m-d'); 
        $passbook->transaction_type=$request->transaction_type; 
        $passbook->total_amount=$request->amount; 
        $passbook->delivery_by_user_id=$user->id; 
        $passbook->receipt_id=$this->receipt($request->amount); 
        $passbook->save(); 
        $response=['status'=>1,'msg'=>'Submit Successfully'];
         return response()->json($response);
     }
    public function receipt($amount)
     { 
         
        
        $Receipt =new Receipt(); 
        $Receipt->amount=$amount;          
        $Receipt->save();
        return $Receipt->id; 
     }
     

}