<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Contact;

class ContactController extends Component
{
    public $newMessage = [];
    public $currentPage = PAGELIST;

    public function render()
    {
        return view('livewire.contact.index')
        ->extends('layouts.master')
        ->section('content');
    }

    public function rules(){
        if($this->currentPage == PAGECREATEFORM){
            return [
                'newMessage.nom' => 'required',
                'newMessage.email' => ['required', 'email'],
                'newMessage.message' => 'required',
            ];
        }
        
    }

    public function goToAddMessage() {
        $this->currentPage = PAGECREATEFORM;
        $this->newMessage = [];
    }

    // Rangement des informations crées par l'utilisateur
    public function addMessage() {
        // Vérifier que les informations de l'utilisateurs sont correctes
        $validationAttributes = $this->validate();

        // // Ajouter un nouveau message
        Contact::create($validationAttributes["newMessage"]);

        $this->newUser = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur créé avec succès!"]);
    }
}
