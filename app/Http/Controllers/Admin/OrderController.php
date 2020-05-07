<?php

namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use App\Model\DeliveryClusterMap;
use App\Model\FinalTransaction;
use App\Model\Passbook;
use App\Model\Transaction;
use App\Model\VillageFarmerMap;
use App\Model\VillageVenderMap;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

class OrderController extends Controller
{
     public function index($value='')
     {
     	return view('admin.order.index');
     }
     public function userOrderList(Request $request,$id)
     { 
        $user_ids=Transaction::where('user_type_id',$id)->where('for_date',$request->id)->distinct('user_id')->get(['user_id']);
        $for_date=$request->id;
        return view('admin.order.user_order_list',compact('user_ids','for_date'));
     }
     public function userOrderListView($user_id,$for_date)
     {
     	$Items=Transaction::where('user_id',$user_id)->where('for_date',$for_date)->get();
        
     	return view('admin.order.user_order_list_view',compact('Items','for_date'));
     }
     //delivery 
     public function orderList($user_type)
     { 
        $data =array();
        $data['user_type'] = $user_type;
        return view('admin.delivery.list',$data);
     }

     public function userTypeOrderList(Request $request,$user_type)
     {  
        $Transaction =new Transaction();
        $user =Auth::guard('admin')->user(); 
        $cluster_village_id =DeliveryClusterMap::where('delivery_id',$user->id)->where('user_type_id',4)->pluck('cluster_village_id')->toArray();
        if ($user_type==3) {
        $village_shg_id =VillageVenderMap::whereIn('village_shg_id',$cluster_village_id)->pluck('vender_id')->toArray();            
        }else{
         $village_shg_id =VillageFarmerMap::whereIn('village_shg_id',$cluster_village_id)->pluck('farmer_id')->toArray(); 
        }

         $user_arr_id=Transaction::where('for_date',$request->id)
                                ->whereIn('user_id',$village_shg_id)
                                ->pluck('user_id')->toArray();
        $users=User::whereIn('id',$user_arr_id)->get();
        $for_date =$request->id;
        return view('admin.delivery.user_order_list',compact('users','for_date'))->render();
     }
     public function userTypeOrderListView($user_id,$for_date)
     {
          
         $orderLists=Transaction::where('for_date',$for_date)->where('user_id',$user_id)->get();
        return view('admin.delivery.user_order_list_view',compact('orderLists','for_date','user_id'));
     }

     public function userTypeOrderListStore(Request $request,$for_date)
    { 
      $user =Auth::guard('admin')->user();
      $rules=[
           
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
            $FinalTransaction=FinalTransaction::firstOrNew(['order_id'=>$request->order_id[$key]]); 
            $FinalTransaction->user_id=$user->id;
            $FinalTransaction->user_type_id=$user->user_type_id;
            $FinalTransaction->for_date=$request->for_date;
            $FinalTransaction->item_id=$key;
            $FinalTransaction->qty=$value;
            $FinalTransaction->rate=$request->rate[$key];
            $FinalTransaction->order_id=$request->order_id[$key];
            $FinalTransaction->save();
            $Passbooks=Passbook::firstOrNew(['order_id'=>$request->order_id[$key]]); 
            $Passbooks->for_date=$request->for_date;
            $Passbooks->order_id=$request->order_id[$key];
            $Passbooks->delivery_date=date('Y-m-d');
            $Passbooks->delivery_by_user_id=$user->id;
            $Passbooks->vendor_id=$request->user_id;
            $Passbooks->save();
          }
          }
          $response=['status'=>1,'msg'=>'Submit Successfully'];
                return response()->json($response);
       
        
    }

}