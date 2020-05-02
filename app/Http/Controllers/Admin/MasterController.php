<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\UserActivity;
use App\Model\Village;
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function villageListTable()
    {
       $Villages =Village::orderBy('name','ASC')->get();
        return view('admin.master.village.village_list_table',compact('Villages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(UserActivity $userActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserActivity $userActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserActivity $userActivity)
    {
        //
    }
}
