<?php

namespace App\Http\Livewire;

use App\Models\Conducteur;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrentPosition extends Component
{
    public function render()
    {
        $driver = Conducteur::where('id', Auth::user()->conducteur_id )->get()[0];

        return view('livewire.current_position.index', [
            "lat_conducteur" => $driver->lat,
            "lng_conducteur" => $driver->Ing,
            "conducteurs" => Conducteur::where('id', Auth::user()->conducteur_id )
            ->paginate(4)
        ])
        ->extends('layouts.master')
        ->section('content'); 
    }

    function store(Request $request){
       
    //    $position = Conducteur::find( Auth::user()->conducteur_id);
    //    dd($position);

       $data = [
        'lat' => $request->lat,
        'Ing' => $request->lng,
       ];

    // dd($data);

    // Mis à jour des informations édités
    Conducteur::find( Auth::user()->conducteur_id )->update($data);
    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Position actualisé avec succès!"]);
    
    return redirect()->route(route:'conducteur.planning.commande');
    
    
       
    }
}
