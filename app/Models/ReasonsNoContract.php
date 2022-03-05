<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReasonsNoContract extends Model
{
    protected $table = 'reasons_no_contracts';
    protected $fillable =['title', 'desc'];
}
