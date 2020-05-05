<?php

namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use App\Model\DeliveryClusterMap;
use App\Model\Transaction;
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
        $village_shg_id =VillageVenderMap::whereIn('village_shg_id',$cluster_village_id)->pluck('vender_id')->toArray();

         $user_arr_id=Transaction::where('for_date',$request->id)
                                ->whereIn('user_id',$village_shg_id)
                                ->pluck('user_id')->toArray();
        $users=User::whereIn('id',$user_arr_id)->get();
        $for_date =$request->id;
        return view('admin.delivery.user_order_list',compact('users','for_date'))->render();
     }

}