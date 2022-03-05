<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $table = 'governorates';
    protected $fillable = ['name_gover', 'Country_id', 'Territory_id'];


    public function TerritoryG()
    {
        return $this->belongsTo(Territory::Class ,'Territory_id');

    }

    public function countryg()
    {
        return $this->belongsTo(Country::Class ,'Country_id');
    }

    public function neighborg()
    {
        return $this->belongsTo('Neighborhood');
    }

    public function citycu()
    {
        return $this->belongsTo('City');
    }
}
