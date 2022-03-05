<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    protected $table = 'neighborhoods';
    protected $fillable =['name', 'Country_id' ,'Territory_id', 'Governorate_id','City_id'];

    public function Country()
    {
        return $this->belongsTo(Country::class ,'Country_id');
    }

    public function Territory()
    {
        return $this->belongsTo(Territory::Class ,'Territory_id');

    }

    public function Governorate()
    {
        return $this->belongsTo(Governorate::Class ,'Governorate_id');
    }
    public function City()
    {
        return $this->belongsTo(City::class,'City_id');
    }

}
