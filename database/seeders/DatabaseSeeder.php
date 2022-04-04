<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\TypeArticle;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
            

         $this->call(RoleTableSeeder::class);
        //  $this->call(WayTableSeeder::class);
        // $this->call(StatutTableSeeder::class);
        // User::factory(8)->create();
        // Reservation::factory(1)->create();
        // $user = User::find(1);
        // $user->role()->attach(2);

        // $user = User::find(2);
        // $user->role()->attach(2);

        // $user = User::find(3);
        // $user->role()->attach(1);

        // $user = User::find(4);
        // $user->role()->attach(2);

        // $user = User::find(5);
        // $user->role()->attach(1);
        

        

        

    }
}
