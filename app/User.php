<?php

namespace App;

//use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{

    use Notifiable ,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $guarded=[];
    /**
     * @var mixed
     */

    public function cities()
    {
        return $this->belongsTo('App\Models\City', 'city','id')->withDefault();
    }
    public function govers()
    {
        return $this->belongsTo('App\Models\Governorate', 'gavers','id');
    }


//    public function roles(){
////        dd($this->belongsTo(Role::Class ,'role_id' ));
//        return $this->belongsTo(Role::Class ,'role_id' );
//
//    }

//    public function hasAbility($permissions)
//    {
//      $allroles = Role::get();
////        dd($allroles);
//
//        $role = $this-> role;
////        dd($role);
////        dd(role);
//        $allpermission = $role->permission;
//        if ($role){
//            return false;
//        }
//        else{
//            foreach ($role->permission as $permission){
//                if (is_array($permissions) && in_array($permissions, $permission)){
//                    return true;
//                }else  if(is_string(($permissions) && strcmp($permissions, $permission))== 0){
//                    return true;
//
//                }
//                return false;
//            }
//        }
//
//    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
