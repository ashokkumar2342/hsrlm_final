<?php

namespace App;

use App\Model\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public function role()
    // {
    //     return $this->belongsToMany(Role::class,'role_admins');
    // }
    protected $fillable = [
        'name', 'email', 'password',
    ];

 
    public function getdetailbyuserid($user_id){
        try {
            return $this->where("id",$user_id)
            ->first();
        } catch (QueryException $e) {
            return $e; 
        }
    }
    public function getAllUser(){
        try {
            return $this->all();
            
        } catch (QueryException $e) {
            return $e; 
        }
    }

    public function updateuserdetail($updArr,$user_id){
        try {
            return $this->where('id',$user_id)
            ->update($updArr);
        } catch (QueryException $e) {
            return $e; 
        }
    }
    public function getUserByUserTypeId($user_type_id){
        try {
            return $this->where('user_type_id',$user_type_id)
            ->get();
        } catch (QueryException $e) {
            return $e; 
        }
    }

    
    
    // public function getArrIdDetailsByRoleId($user_id,$statusArrId)
    // {
    //    $adminArrayId = Admin::
    //                           where('role_id',$request->role_id)
    //                         ->orderBy('first_name','ASC')
    //                         ->pluck('id')
    //                         ->toArray();
    // }
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
