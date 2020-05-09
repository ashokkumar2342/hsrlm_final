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
        $total_amount =0;
        foreach ($request->units as $key => $value) {
          if ($value!=0) {
            $FinalTransaction=FinalTransaction::firstOrNew(['id'=>$request->f_t_id]); 
            $FinalTransaction->user_id=$request->user_id;
            $FinalTransaction->user_type_id=$request->user_type_id;
            $FinalTransaction->for_date=$request->for_date;
            $FinalTransaction->item_id=$key;
            $FinalTransaction->qty=$value;
            $FinalTransaction->rate=$request->rate[$key];
            $FinalTransaction->order_id=$request->order_id;
            $FinalTransaction->save();
            $total_amount += $value*$request->rate[$key];
            }
          }
          $Passbooks=Passbook::firstOrNew(['order_id'=>$request->order_id]); 
          $Passbooks->for_date=$request->for_date;
          $Passbooks->order_id=$request->order_id;
          $Passbooks->delivery_date=date('Y-m-d');
          $Passbooks->delivery_by_user_id=$user->id;
          $Passbooks->user_id=$request->user_id;
          $Passbooks->total_amount=$total_amount;
          $Passbooks->transaction_type=1;
          $Passbooks->on_date=$request->for_date;
          $Passbooks->save();
          $response=['status'=>1,'msg'=>'Submit Successfully'];
                return response()->json($response);
       
        
    }

    public function userOrderListExport(Request $request)
    {

        
       
 
         $user_id=Transaction::where('for_date',$request->for_date)
                                ->where('user_type_id',$request->user_type_id)
                                ->pluck('user_id')->toArray();
         if (!empty($user_id)) {
             if ($request->user_type_id==3) { 
             $village_shg_id =VillageVenderMap::whereIn('vender_id',$user_id)->pluck('village_shg_id')->toArray();            
             }elseif($request->user_type_id==2){
              $village_shg_id =VillageFarmerMap::whereIn('farmer_id',$user_id)->pluck('village_shg_id')->toArray(); 
             }  
           
            $delivery_id =DeliveryClusterMap::where('cluster_village_id',$village_shg_id)->where('user_type_id',4)->pluck('delivery_id')->toArray(); 
                                     
           $deliverys=User::whereIn('id',$delivery_id)->get();
           $users=User::whereIn('id',$user_id)->get();


            $for_date =$request->id;
           $data =array();
           $data['deliverys'] =$deliverys;
           $data['users'] =$users;
           $data['for_date'] =$request->for_date;
           $data['user_type_id'] =$request->user_type_id;
            $pdf = PDF::setOptions([
                'logOutputFile' => storage_path('logs/log.htm'),
                'tempDir' => storage_path('logs/')
            ])
            ->loadView('admin.order.report',$data);
            return $pdf->stream('report.pdf');
         } else{ 
            return redirect()->route('admin.order.index')->with(['message'=>"Not Available",'class'=>'error']);
         }                      
         
    }

}