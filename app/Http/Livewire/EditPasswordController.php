<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EditPasswordController extends Component
{
    public $currentPage = PAGELIST;
    public $editPassword = [];

    public function render()
    {
        return view('livewire.editpassword.index')
        ->extends('layouts.master')
        ->section('content');
    }

    public function goToChangePassword($id) {
        $this->editUser = User::find($id)->toArray();
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToResetPassword($id) {
        $this->editUser = User::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function confirmPwdReset(){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de réinitialiser le mot de passe de cet utilisateur. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning"
        ]]);
    }

    public function resetPassword(){

        User::find(Auth::user()->id)->update(["password"=> Hash::make(DEFAULTPASSWORD)]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Mot de passe utilisateur réinitialisé avec succès!"]);
    }

    public function rules(){
        if($this->currentPage == PAGECREATEFORM){

            return [
                'editPassword.password' => ['required', 'string', 'min:8', 'confirmed'],
                // 'editPassword.password_confirmation' => ['required', 'string', 'min:8', 'confirmed'],
            ];
        }
    }

    public function updateUser() {
        // Vérifier que les informations de l'utilisateurs sont correctes
        $validationAttributes = $this->validate();

        // Mis à jour des informations édités
        User::find(Auth::user()->id)->update(["password"=> Hash::make($validationAttributes["editPassword"]["password"])]);
        
        //Popup de confirmation de la mise à jour
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Mot de passe changé avec succès!"]);    
    }
}
