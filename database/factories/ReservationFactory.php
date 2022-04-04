<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @var string
     */

    protected $model = Reservation::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'conducteur_id' => '1',
            'conducteur' => 'Bernard',
            'transport' => 'moto',
            'plaque' => '45874560',
            'client_id' => '1',
            'latTo' => '2.35',
            'IngTo' => '2.45',
            'latFrom' => '1.45',
            'IngFrom' => '1.652',
            'prix' => '4000',
            'dateDepart' => '10/10/22',
            'heureDepart' => '4',
            'distance' => '40',
        ];
    }
}
