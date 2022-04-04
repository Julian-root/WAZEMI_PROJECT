<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;


    protected $fillable = [
        'conducteur_id',
        'conducteur',
        'transport',
        'client_id',
        'note',
        'client',
        'latTo',
        'IngTo',
        'latFrom',
        'course_end',
        'IngFrom',
        'prix',
        'dateDepart',
        'dateArrivee',
        'client_course_end',
        'driver_course_end',
        'plaque',
        'distance',
        'status',
    ];
}
