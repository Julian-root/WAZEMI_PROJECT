<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
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
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'sexe' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'telephone1' => $this->faker->unique()->phoneNumber,
            'telephone2' => $this->faker->unique()->phoneNumber,
            'pieceIdentite' => $this->faker->lastName,
            'numeroPieceIdentite' => $this->faker->unique()->bankAccountNumber,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }

}
