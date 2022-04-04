<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Conducteur;
use App\Models\Client;
use App\Models\Way;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['profil'] === 'client' ) {
            return Validator::make($data, [
                'nom' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'prenom' => ['required'],
                'sexe' =>['required'],
                'numeroTelephone' => ['required', 'numeric', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }else {
            return Validator::make($data, [
                'nom' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'prenom' => ['required'],
                'sexe' =>['required'],
                'numeroTelephone' => ['required', 'numeric', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'pieceIdentite' => ['required'],
                'numeroPieceIdentite' => ['required', 'numeric', 'unique:conducteurs'],
                'typePermis' => ['required'],
                'numeroPermis' => ['required', 'unique:conducteurs'],
                'plaqueImmatriculation' => ['required', 'numeric', 'unique:conducteurs'],
            ]);
        }
    }
    
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if($data['profil'] === 'client' ) {
            $profil = new Client;
        }else {
            $profil = new Conducteur([
                'pieceIdentite' => $data['pieceIdentite'],
                'numeroPieceIdentite' => $data['numeroPieceIdentite'],
                'typePermis' => $data['typePermis'],
                'numeroPermis' => $data['numeroPermis'],
                'plaqueImmatriculation' => $data['plaqueImmatriculation'],
            ]);
        }

        

        $user = new User([
            'nom' => $data['nom'],
            'email' => $data['email'],
            'prenom' => $data['prenom'],
            'sexe' => $data['sexe'],
            'numeroTelephone' => $data['numeroTelephone'],
            'password' => Hash::make($data['password']),
        ]);
        $profil->save();
        $profil->users()->save($user);

        $user_new = User::whereEmail( $data['email'] )->first();

        Way::create([
            'user_id' => $user_new->id,
        ]);

        $user = User::find($user_new->id);

        $user->role()->attach($data['profil'] === 'client' ? 1 : 2);
        
        return $user;

        
    }
}
