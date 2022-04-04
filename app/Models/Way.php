<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Way extends Model
{
    use HasFactory;

    protected $fillable = [
        'way_id',
        'user_id',
    ];
    
    public $timestamps = false;

}

