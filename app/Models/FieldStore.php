<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldStore extends Model
{
    protected $table = 'field_stores';
    protected $fillable =['title', 'desc'];
}
