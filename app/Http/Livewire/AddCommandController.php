<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use DateTimeImmutable;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\Component;

class AddCommandController extends Component
{
    public $currentPage = PAGELIST;
    public $num_commandes_ratings = "";
    public $filtreStatut = "";



    public function render()
    {
        $commandQuery = Reservation::query();

        if ($this->filtreStatut != "") {
            $commandQuery->where("status", $this->filtreStatut);
        }

        $currentTime = new DateTimeImmutable(timezone: new DateTimeZone('Africa/Porto-Novo'));
        return view('livewire.listcommandes.index', [
            "currentTime" => $currentTime,
            "commandes" => $commandQuery->where('client_id', Auth::user()->client_id)
                ->latest()
                ->paginate(4)
        ])
            ->extends('layouts.master')
            ->section('content');
    }

    // Suppression d'une commande 
    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" => "Vous êtes sur le point de supprimer cette commande de la liste des commandes. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "commande_id" => $id
            ]
        ]]);
    }
    public function deleteCommande($id)
    {
        Reservation::destroy($id);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Commande supprimé avec succès!"]);
    }

    public function acceptCommande($id)
    {
        $data = [
            'status' => "enCours",
        ];
        // Mis à jour des informations édités
        Reservation::find($id)->update($data);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Commande en cours"]);
    }

    // Ratings
    public function ratingCommand($id)
    {

        $this->num_commandes_ratings = $id;
        dd($this->num_commandes_ratings);
        $this->currentPage = PAGECREATEFORM;
    }

    function store(Request $request)
    {

        $dat = [
            'note' => $request->rating,
        ];
        // dd($this->num_commandes_ratings);


        $id = $this->num_commandes_ratings;


        Reservation::find($id)->update($dat);
        return redirect()->route(route: 'client.listcommande.commandes');
    }

    // End Command
    public function endCommand($id)
    {
            $data = [
                'client_course_end' => 1,
                'status' => "Termine",
            ];
            // Mis à jour des informations édités
            Reservation::find($id)->update($data);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Course Terminé"]);
    }
}
