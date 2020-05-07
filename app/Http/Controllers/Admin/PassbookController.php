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
        $passbooks =Passbook::where('for_date',$reqeust->for_date)->where('vendor_id',$user->id)->get();
        $data =array();
        $data['passbooks'] =$passbooks;
        return view('admin.passbook.passbook_table',$data);
     }
     

}