<?php

namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use App\Model\UserActivity;
use App\Model\Village;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
        return view('admin.master.items.items_list');
    }
    public function addItems()
    {
        return view('admin.master.items.add_form');
    }
    public function adminssionSeatStore(Request $request,$id=null)
      { 
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
            else {
             $adminssionSeat=AdmissionSeat::firstOrNew(['id'=>$id]);  
             $adminssionSeat->academic_year_id=$request->academic_year_id;  
             $adminssionSeat->class_id=$request->class_id;  
             $adminssionSeat->total_seat=$request->total_seat;  
             $adminssionSeat->form_fee=$request->from_fee;  
             $adminssionSeat->from_date=$request->from_date;  
             $adminssionSeat->last_date=$request->last_date; 
             $adminssionSeat->test_date=$request->test_date; 
             $adminssionSeat->retest_date=$request->retest_date; 
             $adminssionSeat->result_date=$request->result_date;
             if ($request->hasFile('attachment')) { 
              $attachment=$request->attachment;
              $filename='test_syllabus'.date('d-m-Y').time().'.pdf'; 
              $attachment->storeAs('student/admissionschedule/syllabus/',$filename);
              $adminssionSeat->syllabus=$filename;
              } 
             $adminssionSeat->save();
              $response=['status'=>1,'msg'=>'Submit Successfully'];
            }     return response()->json($response);
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
    {  
      $user =new User();
      $to_users =$user->getUserByUserTypeId(2);
      $data=array();
      $data['to_users'] = $to_users;
      return view('admin.master.mapping.to_user',$data);
    } 
    public function villageFarmerStore(Request $request)
    { 
      $rules=[
          'farmer_id' => 'required',
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
         $adminssionSeat=AdmissionSeat::firstOrNew(['id'=>$id]);  
          
         $adminssionSeat->save();
          $response=['status'=>1,'msg'=>'Save Successfully'];
        }  
      
      return $response;
    }    

}
