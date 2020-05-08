<?php

namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use App\Model\Passbook;
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
     public function passbookTable(Request $reqeust)
     {
        $user =Auth::guard('admin')->user();
        $passbooks =Passbook::where('for_date',$reqeust->for_date)->where('vendor_id',$user->id)->get();
        $data =array();
        $data['passbooks'] =$passbooks;
        return view('admin.passbook.passbook_table',$data);
     }
     public function userList($user_type_id)
     {
        $users=User::where('user_type_id',$user_type_id)->pluck('id')->toArray();
        $passbooks=Passbook::whereIn('user_id',$users)->distinct('user_id')->get(['user_id']);
        return view('admin.delivery.finance.user_list',compact('passbooks')); 
     }
     

}