<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calculate extends Model
{
    protected $fillable = ['user_id', 'radius', 'height', 'volume'];
    protected $table = 'calculations';    
}
