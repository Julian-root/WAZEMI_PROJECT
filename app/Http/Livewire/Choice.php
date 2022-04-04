<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Choice extends Component
{
    // Gestion du switch entre les différentes bloc-page de l'utilisateur
    public $currentPage = PAGELIST;
    
    
    public function render()
    {
        return view('auth.register')
        ->extends('layouts.auth')
        ->section('form'); 
    }

    // Affichage du formulaire d'inscription du client
    public function goToAddClient() {
        $this->currentPage = PAGEEDITFORM;
    }

    // Affichage du formulaire d'inscription du conducteur
    public function goToAddConducteur() {
        $this->currentPage = PAGECREATEFORM;
    }
}
