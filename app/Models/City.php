<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['name_city', 'Country_id', 'Territory_id', 'Governorate_id'];

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

    public function CountrysC()
    {
        return $this->hasOne(App\Country::class ,'Country_id');
    }

    public function TerritoryC()
    {
        return $this->hasOne(App\Territory::Class ,'Territory_id');

    }

    public function GovernorateC()
    {
        return $this->hasOne(App\Governorate::Class ,'Governorate_id');
    }

    public function neighbor()
    {
        return $this->belongsTo('App\City');
    }
}
