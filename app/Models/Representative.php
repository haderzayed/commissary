<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Representative extends Model
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password' ,'role_id', 'username' ,'mobile' ,'gavers' ,'city','id_number' ,'role'
    ];
    public function hasAbility ($permissions)
    {
        $roles = $this->role;
        if ($roles){
            return false;
        }
        else{
            foreach ($roles->permissions as $permission){
                if (is_array($permissions) && in_array($permissions , $permission)){
                    return true;
                }else  if(is_string(($permissions) && strcmp($permissions, $permission))== 0){
                    return true;

                }
                return false;
            }
        }

    }
    public function cities()
    {
        return $this->belongsTo('App\Models\City', 'city','id');
    }
    public function govers()
    {
        return $this->belongsTo('App\Models\Governorate', 'gavers','id');
    }


    public function role(){
        return $this->belongsTo(Role::Class ,'role_id' );
    }
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

