<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'pieceIdentite',
        'numeroPieceIdentite',
        'typePermis',
        'numeroPermis',
        'plaqueImmatriculation',
        'lat',
        'Ing',
        'estDisponible',
    ];

    public $timestamps = false;

    public function users() {
        return $this->hasOne(User::class,"conducteur_id");
    }

    public function commandes() {
        return $this->hasOne(Reservation::class,"conducteur_id");
    }
}
