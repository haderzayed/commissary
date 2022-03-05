<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    protected $table = 'territories';
    protected $fillable = ['name_terr', 'Country_id'];


    public function countryt()
    {
        return $this->belongsTo(Country::Class ,'Country_id');

    }
    public function Governoratet()
    {
        return $this->hasOne(Governorate::Class);
    }
    public function neighbort()
    {
        return $this->belongsTo('Neighborhood');
    }

    public function cityct()
    {
        return $this->belongsTo('City');
    }
}
