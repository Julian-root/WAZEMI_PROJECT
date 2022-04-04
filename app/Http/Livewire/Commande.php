<?php

namespace App\Http\Livewire;

use App\Models\Conducteur;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\User;
use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

class Commande extends Component
{
    // Gestion de la pagination au niveau de la liste des commandes
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $newCommand = [];

    // Gestion du switch entre les différentes bloc-page de l'utilisateur
    public $currentPage = PAGECHOICEDRIVER;
    public $currentDate;

    public function __construct()
    {
        $this->currentDate = new DateTimeImmutable(timezone: new DateTimeZone('Africa/Porto-Novo'));

    }
    
    public function render()
    {
        
        $currentTime = new DateTimeImmutable(timezone: new DateTimeZone('Africa/Porto-Novo'));
        return view('livewire.commandes.index', [
            "currentTime" => $currentTime,
            "commandes" => Reservation::where('client_id', Auth::user()->client_id )->latest()
            ->paginate(4)
        ])
        ->extends('layouts.master')
        ->section('content'); 
    }



    // Affichage de la page de choix du type de reservation
    public function goToChoiceCommand() {
        $this->currentPage = PAGECHOICEDRIVER;
    }

    public function addCommand() {

        dd($this->newCommand);

        $latitudeFrom    = $this->newCommand["lat"];
        $longitudeFrom    = $this->newCommand["lng"];
        $latitudeTo        = $this->newCommand["lat2"];
        $longitudeTo    = $this->newCommand["lng2"];
        
        $theta    = $longitudeFrom - $longitudeTo;
        $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = $dist * 60 * 1.1515;

        // Convert unit and return distance
        $unit = "K";       
        if($unit == "K"){
            $road_km = round($miles * 1.609344, 2);
            $price = $road_km *200;
            if( $this->newCommand["way"] == "moto") {
                $min = (int)($road_km * 2);
            }else {
                $min = (int)($road_km * 2);
            }  
        }elseif($unit == "M"){
            $road_km = round($miles * 1609.344, 2).' meters';
        }else{
            $road_km = round($miles, 2).' miles';
        }

        // Choisir les chauffeurs disponibles    
        $choice_drivers = Conducteur:: where('typePermis', $this->newCommand["way"] )->get()->toArray();
        $drivers_available = [];
        

        foreach ($choice_drivers as $choice_driver) { 

            // Filtrage des commandes en cours pour ce chauffeur
            $commandes = Reservation::where('conducteur_id', $choice_driver['id'] )
                                    ->get()
                                    ->toArray();
            $disponible = true;
            foreach ($commandes as $commande) {

                if(
                    ( ( (new DateTimeImmutable($commande['dateDepart'], timezone: new DateTimeZone('Africa/Porto-Novo')))    <   (new DateTimeImmutable($commande['dateArrivee'], timezone: new DateTimeZone('Africa/Porto-Novo'))) ) &&
                    (  (new DateTimeImmutable($commande['dateArrivee'], timezone: new DateTimeZone('Africa/Porto-Novo')))   <   (new DateTimeImmutable($this->newCommand["date"], timezone: new DateTimeZone('Africa/Porto-Novo')))  ) &&
                    ( (new DateTimeImmutable($this->newCommand["date"], timezone: new DateTimeZone('Africa/Porto-Novo')))  <   ((new DateTimeImmutable($this->newCommand["date"], timezone: new DateTimeZone('Africa/Porto-Novo')))->add( new DateInterval("P0Y0M0DT2H0M0S") ) ) )  )    
                    ||
                    ( ( (new DateTimeImmutable($this->newCommand["date"], timezone: new DateTimeZone('Africa/Porto-Novo')))    <   ((new DateTimeImmutable($this->newCommand["date"], timezone: new DateTimeZone('Africa/Porto-Novo')))->add( new DateInterval("P0Y0M0DT2H0M0S") ) ) ) &&
                    (  ((new DateTimeImmutable($this->newCommand["date"], timezone: new DateTimeZone('Africa/Porto-Novo')))->add( new DateInterval("P0Y0M0DT2H0M0S") ) )   <   (new DateTimeImmutable($commande['dateDepart'], timezone: new DateTimeZone('Africa/Porto-Novo')))  ) &&
                    ( (new DateTimeImmutable($commande['dateDepart'], timezone: new DateTimeZone('Africa/Porto-Novo')))  <   (new DateTimeImmutable($commande['dateArrivee'], timezone: new DateTimeZone('Africa/Porto-Novo'))) )  )
                    ) {

                        continue;
                }

                    $disponible = false;
                    break;
            }

            if($disponible) {
                $drivers_available[] = $choice_driver;
            }
        }

    // Trouver le chauffeur disponible le plus proche
        $distance = 100000000000000;
        foreach($drivers_available as $driver) {

            $theta    = $longitudeFrom - $driver['Ing'];
            $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($driver['lat'])) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($driver['lat'])) * cos(deg2rad($theta));
            $dist    = acos($dist);
            $dist    = rad2deg($dist);
            $mile    = $dist * 60 * 1.1515;

            if($distance > $mile) {

                $distance = $mile;
                $choice = $driver['id'];
            }
        }

        //Informations du  chauffeur
        $name_drivers = User::where('conducteur_id', $choice )
                              ->get()
                              ->toArray();
        foreach ($name_drivers as $name_driver) {
            $nom_conducteur = $name_driver['prenom'];
        }

        $drivers = Conducteur::where('id', $choice )->get()->toArray();
        foreach ($drivers as $driver) {
            $plaque_conducteurs = $driver['plaqueImmatriculation'];
            $transport_conducteurs = $driver['typePermis'];
        }

        $id = Auth::user()->client_id;
        $client = Auth::user()->prenom;
        
        Reservation::create([
            'conducteur_id' => $choice,
            'client_id' => $id,
            'latTo' => $latitudeTo,
            'IngTo' => $longitudeTo,
            'latFrom' => $latitudeFrom,
            'IngFrom' => $longitudeFrom,
            'prix' => $price,
            'transport' => $transport_conducteurs,
            'client'  => $client,
            'conducteur' => $nom_conducteur,
            'plaque' => $plaque_conducteurs,
            'dateDepart' => $this->newCommand["date"],
            'dateArrivee' => ( ((new DateTimeImmutable($this->newCommand["date"], timezone: new DateTimeZone('Africa/Porto-Novo')))->add( new DateInterval("P0Y0M0DT2H".$min."M0S") ) )->format('Y-m-d H:i:s') ),
            'distance' => $road_km,
        ]);
        $this->dispatchBrowserEvent("showConfirm", ["message"=> [
            // "text" => "Le chauffeur " .$nom_conducteur." viendra vous chercher à ".$this->newCommand["way"].". Le prix de la commande est de ".$price." FCFA pour une distance de ".$road_km." km. Votre code de confirmation est le 1234",
            "text" => "Le chauffeur viendra vous chercher . Le prix de la commande est de FCFA pour une distance de km. Votre code de confirmation est le 1234",
            "title" => "WAZEMI vous remercie d'avoir passé une commande",
            "type" => "success",
            "data" => [
                "commande_id" => 1
            ]
        ]]);
        $this->newCommand = [];
    }

    public function goToListCommand(){
        return redirect()->route(route:'client.listcommande.commandes');
    }

    // Suppression d'une commande 
    public function confirmDelete($id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer cette commande de la liste des commandes. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "commande_id" => $id
            ]
        ]]);
    }
    public function deleteCommande($id){
        Reservation::destroy($id);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Commande supprimé avec succès!"]);
    }

    public function acceptCommande($id){
        $data = [
            'status' => "enCours",
        ];
        // Mis à jour des informations édités
        Reservation::find( $id )->update($data);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Commande en cours"]);
    }

    // Affichage du formulaire de la commande
    public function goToAddCommandPresent() {
        $this->currentPage = PAGELIST;
    }

    

}
















































// //Calcul de la distance de la course
// function store(Request $request){

//     // dd($request);
//     // Calcul de la distance
//         $latitudeFrom    = $request->lat;
//         $longitudeFrom    = $request->lng;
//         $latitudeTo        = $request->lat2;
//         $longitudeTo    = $request->lng2;
        
//         $theta    = $longitudeFrom - $longitudeTo;
//         $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
//         $dist    = acos($dist);
//         $dist    = rad2deg($dist);
//         $miles    = $dist * 60 * 1.1515;

//         // Convert unit and return distance
//         $unit = "K";
                
//         if($unit == "K"){
//             $road_km = round($miles * 1.609344, 2);
//             $price = $road_km *200;  
//             $min = (int)($road_km * 2);
//             // dd($min);
//         }elseif($unit == "M"){
//             $road_km = round($miles * 1609.344, 2).' meters';
//         }else{
//             $road_km = round($miles, 2).' miles';
//         }

//     // Choisir les chauffeurs disponibles    
//         $choice_drivers = Conducteur::where('typePermis', $request->way )
//                                     ->
//                                     get()
//                                     ->toArray();
//         // dd($choice_drivers);
//         $drivers_available = [];
        

//         foreach ($choice_drivers as $choice_driver) { 

//             // Filtrage des commandes en cours pour ce chauffeur
//             $commandes = Reservation::where('conducteur_id', $choice_driver['id'] )
//                                     ->get()
//                                     ->toArray();
//             $disponible = true;
//             foreach ($commandes as $commande) {

//                 if(
                    
//                     ( ( (new DateTimeImmutable($commande['dateDepart'], timezone: new DateTimeZone('Africa/Porto-Novo')))    <   (new DateTimeImmutable($commande['dateArrivee'], timezone: new DateTimeZone('Africa/Porto-Novo'))) ) &&
//                     (  (new DateTimeImmutable($commande['dateArrivee'], timezone: new DateTimeZone('Africa/Porto-Novo')))   <   (new DateTimeImmutable($request->date, timezone: new DateTimeZone('Africa/Porto-Novo')))  ) &&
//                     ( (new DateTimeImmutable($request->date, timezone: new DateTimeZone('Africa/Porto-Novo')))  <   ((new DateTimeImmutable($request->date, timezone: new DateTimeZone('Africa/Porto-Novo')))->add( new DateInterval("P0Y0M0DT2H0M0S") ) ) )  )    
//                     ||
//                     ( ( (new DateTimeImmutable($request->date, timezone: new DateTimeZone('Africa/Porto-Novo')))    <   ((new DateTimeImmutable($request->date, timezone: new DateTimeZone('Africa/Porto-Novo')))->add( new DateInterval("P0Y0M0DT2H0M0S") ) ) ) &&
//                     (  ((new DateTimeImmutable($request->date, timezone: new DateTimeZone('Africa/Porto-Novo')))->add( new DateInterval("P0Y0M0DT2H0M0S") ) )   <   (new DateTimeImmutable($commande['dateDepart'], timezone: new DateTimeZone('Africa/Porto-Novo')))  ) &&
//                     ( (new DateTimeImmutable($commande['dateDepart'], timezone: new DateTimeZone('Africa/Porto-Novo')))  <   (new DateTimeImmutable($commande['dateArrivee'], timezone: new DateTimeZone('Africa/Porto-Novo'))) )  )
//                     ) {

//                         continue;
//                 }

//                     $disponible = false;
//                     break;
//             }

//             if($disponible) {
//                 $drivers_available[] = $choice_driver;
//             }
//         }

//         // $rand_keys = array_rand( $drivers_available);

//         // $choice = $drivers_available[$rand_keys]['id'];
//         // dd($choice);

//     // Trouver le chauffeur disponible le plus proche
//         $distance = 100000000000000;
//         foreach($drivers_available as $driver) {

//             $theta    = $longitudeFrom - $driver['Ing'];
//             $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($driver['lat'])) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($driver['lat'])) * cos(deg2rad($theta));
//             $dist    = acos($dist);
//             $dist    = rad2deg($dist);
//             $mile    = $dist * 60 * 1.1515;

//             if($distance > $mile) {

//                 $distance = $mile;
//                 $choice = $driver['id'];
//             }
//         }

//         //Informations du  chauffeur
//         $name_drivers = User::where('conducteur_id', $choice )
//                               ->get()
//                               ->toArray();
//         foreach ($name_drivers as $name_driver) {
//             $nom_conducteur = $name_driver['prenom'];
//         }

//         $drivers = Conducteur::where('id', $choice )->get()->toArray();
//         foreach ($drivers as $driver) {
//             $plaque_conducteurs = $driver['plaqueImmatriculation'];
//             $transport_conducteurs = $driver['typePermis'];
//         }

//         $id = Auth::user()->client_id;
//         $client = Auth::user()->prenom;
        
//         Reservation::create([
//             'conducteur_id' => $choice,
//             'client_id' => $id,
//             'latTo' => $latitudeTo,
//             'IngTo' => $longitudeTo,
//             'latFrom' => $latitudeFrom,
//             'IngFrom' => $longitudeFrom,
//             'prix' => $price,
//             'transport' => $transport_conducteurs,
//             'client'  => $client,
//             'conducteur' => $nom_conducteur,
//             'plaque' => $plaque_conducteurs,
//             'dateDepart' => $request->date,
//             'dateArrivee' => ( ((new DateTimeImmutable($request->date, timezone: new DateTimeZone('Africa/Porto-Novo')))->add( new DateInterval("P0Y0M0DT2H".$min."M0S") ) )->format('Y-m-d H:i:s') ),
//             'distance' => $road_km,
//         ]);
        
//         return redirect()->route(route:'client.listcommande.commandes');
//     }
