<?php

namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use App\Model\Transaction;
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
}