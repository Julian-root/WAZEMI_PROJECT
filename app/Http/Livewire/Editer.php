<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use App\Models\Conducteur;
use App\Models\User;

class Editer extends Component
{
    // Variables permettant le switch entre les pages
    public $currentPage = PAGELIST;
    public $editUser = [];
    
    // Règles de validation des valeurs edités 
    public function rules(){
        if($this->currentPage == PAGEEDITFORM){

            return [
                'editUser.nom' => 'required',
                'editUser.prenom' => 'required',
                'editUser.email' => ['required', 'email', Rule::unique("users", "email")->ignore($this->editUser['id']) ] ,
                'editUser.numeroTelephone' => ['required', 'numeric', Rule::unique("users", "numeroTelephone")->ignore($this->editUser['id']) ]  ,
                'editUser.sexe' => 'required',
            ];
        }
    }

    public function render()
    {
        return view('livewire.editer.index')
        ->extends('layouts.master')
        ->section('content');
    }

    //
    public function goToEditUser($id) {
        $this->editUser = User::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    } 

    // Rangement des informations éditées par le client ou le conducteur
    public function updateUser() {
        // Vérifier que les informations de l'utilisateurs sont correctes
        $validationAttributes = $this->validate();

        // Rangements des infos edités par le client et le conducteur
        $dataUser = [
            'nom' => $validationAttributes["editUser"]["nom"],
            'email' => $validationAttributes["editUser"]["email"],
            'prenom' => $validationAttributes["editUser"]["prenom"],
            'sexe' => $validationAttributes["editUser"]["sexe"],
            'numeroTelephone' => $validationAttributes["editUser"]["numeroTelephone"],
        ];

        // Mis à jour des informations édités
        User::find($this->editUser["id"])->update($dataUser);
        
        //Popup de confirmation de la mise à jour
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Profil mis à jour avec succès!"]);    
    }
}
