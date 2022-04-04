<?php

namespace App\Http\Livewire;

use App\Models\Conducteur;
use App\Models\Reservation;
use App\Models\Way;
use DateTimeImmutable;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class PlanningController extends Component
{
    // Gestion de la pagination au niveau de la liste des commandes
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $filtreStatut = "";

    public function render()
    {
        $currentTime =new DateTimeImmutable(timezone: new DateTimeZone('Africa/Porto-Novo'));

        $commandQuery = Reservation::query();
        if($this->filtreStatut != "") {
            $commandQuery->where("status", $this->filtreStatut);
        }
            
        return view('livewire.planning.index', [
                "currentTime" => $currentTime,
                "commandes" => $commandQuery->where('conducteur_id', Auth::user()->conducteur_id ) 
                // ->orwhere('status', 'Valide' )
                // ->orwhere('status', 'enCours')
                // ->orwhere('status', 'Termine' )
                ->latest()
                ->paginate(4)
            ])
            ->extends('layouts.master')
            ->section('content'); 
    }

    public function acceptCommande($id){

        $data = [
            'status' => "Valide",
        ];
        // Mis à jour des informations édités
        Reservation::find( $id )->update($data);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Commande acceptée"]);
    }

    // Road Command
    public function roadCommand($id) {

        $available = [
            'way_id' => $id,
        ];
        // Mis à jour des informations édités
        Way::where('user_id', Auth::user()->id )->update($available);
        return redirect()->route(route:'conducteur.road.commande'); 
    }

    // End Command
    public function endCommand($id) {

        $courses = Reservation::where('id', $id )->get()->toArray();
        foreach ($courses as $course) {
            $number_course = $course['course_end'];
        }

        if($number_course == 0) {

            $data = [
                'driver_course_end' => 1,
                'course_end' => 1,
            ];
            // Mis à jour des informations édités
            Reservation::find( $id )->update($data);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Course en cours d'etre terminé"]);

             
        }else {

            $data = [
                'driver_course_end' => 1,
                'status' => "Termine",
            ];
            // Mis à jour des informations édités
            Reservation::find( $id )->update($data);
            $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Course terminée"]);

        }
    }
}
