<?php

namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use App\Model\DeliveryClusterMap;
use App\Model\FinalTransaction;
use App\Model\Passbook;
use App\Model\Transaction;
use App\Model\VillageVenderMap;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

class PassbookController extends Controller
{
     public function list()
     {
        
     	return view('admin.passbook.list');
     } 
     public function passbookTable(Request $reqeust)
     {
        $user =Auth::guard('admin')->user();
        $passbooks =Passbook::whereBetween('on_date',array($reqeust->from_date,$reqeust->to_date))->where('user_id',$user->id)->get();
        $credit =Passbook::whereBetween('on_date',array($reqeust->from_date,$reqeust->to_date))->where('user_id',$user->id)->where('transaction_type',1)->sum('total_amount');
        $debit =Passbook::whereBetween('on_date',array($reqeust->from_date,$reqeust->to_date))->where('user_id',$user->id)->where('transaction_type',2)->sum('total_amount');
        $balance = $credit - $debit;
        $data =array();
        $data['passbooks'] =$passbooks;
        $data['balance'] =$balance;
        $response =array();
        $response['status']=1;       
         $response['data'] =view('admin.passbook.passbook_table',$data)->render();
         return $response;
     }
     

}