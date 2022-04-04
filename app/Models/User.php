<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'numeroTelephone',
        'email',
        'password',
        'imageUrl',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function clients() {
        return $this->belongsTo(Client::class,"client_id");
    }

    public function conducteurs() {
        return $this->belongsTo(Conducteur::class,"client_id");
    }

    public function role() {
        return $this->belongsToMany(Role::class,"role_utilisateurs", "user_id", "role_id");
    }
    
    /* Authentificate Role Users */

    public function hasRole($role) {
        return $this->role()->where("nom", $role)->first() !== null;
    }

    public function hasManyRoles($roles) {
        return $this->role()->whereIn("nom", $roles)->first() !== null;
    }

    public function getAllRoleNamesAttribute() {
        return $this->role->implode("nom", '|');
    }
}
