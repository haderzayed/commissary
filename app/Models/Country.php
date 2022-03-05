<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['name_coun', 'decs'];


    public function TerritoryCU()

    {
        return $this->hasOne(Territory::Class);

    }

    public function GovernorateCU()
    {
        return $this->hasOne(Governorate::Class);
    }

    public function neighbor()
    {
        return $this->belongsTo('Neighborhood');
    }
    public function citycu()
    {
        return $this->belongsTo('City');
    }
}
