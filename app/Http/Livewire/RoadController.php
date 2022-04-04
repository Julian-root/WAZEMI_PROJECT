<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use App\Models\Way;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RoadController extends Component
{
    public function render()
    {

        $ways = Way::where('user_id', Auth::user()->id )->get()->toArray();
        foreach ($ways as $way) {

            $way_id = $way['way_id'];
        }

        $roads = Reservation::where('id', $way_id )->get()->toArray();

        foreach ($roads as $road) {
            $coord_latTo = $road['latTo'];
            $coord_latFrom = $road['latFrom'];
            $coord_IngTo = $road['IngTo'];
            $coord_IngFrom = $road['IngFrom'];
        }

        return view('livewire.road.index', [
            "latTo" => $coord_latTo,
            "latFrom" => $coord_latFrom,
            "IngTo" => $coord_IngTo,
            "IngFrom" => $coord_IngFrom,
        ])
        ->extends('layouts.master')
        ->section('content'); 
    }
}
