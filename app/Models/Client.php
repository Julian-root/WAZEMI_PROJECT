<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
    
    ];

    public $timestamps = false;

    public function users() {
        return $this->hasOne(User::class,"client_id");
    }

    public function commandes() {
        return $this->hasOne(Reservation::class,"client_id");
    }
}
