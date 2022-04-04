<?php

use App\Http\Livewire\AddCommandController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Utilisateurs;
use App\Http\Livewire\Choice;
use App\Http\Livewire\Commande;
use App\Http\Livewire\ContactController;
use App\Http\Livewire\CurrentPosition;
use App\Http\Livewire\Editer;
use App\Http\Livewire\EditPasswordController;
use App\Http\Livewire\MessagesController;
use App\Http\Livewire\PlanningController;
use App\Http\Livewire\RoadController;
use GuzzleHttp\Psr7\Message;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/enregistrer', Choice::class, 'index')->name('choice_type_register.index');

// Le groupe des routes relatives uniquement aux clients
Route::group([
    "middleware" => ["auth", "auth.client"],
    "as" => "client."

], function(){

    Route::group([
        "prefix" => "habilitations",
        "as" => "habilitations."
    
    ], function(){
            Route::get('/utilisateurs', Utilisateurs::class, 'index')->name('users.index');
    });

    Route::group([
        "prefix" => "commande",
        "as" => "commande."
    
    ], function(){
            Route::get('/commandes', Commande::class)->name('commandes');
            Route::post('/store',[Commande::class, 'store'])->name('store');
    });

    Route::group([
        "prefix" => "listcommande",
        "as" => "listcommande."
    
    ], function(){
            Route::get('/listcommandes', AddCommandController::class)->name('commandes');
            Route::post('/ratings_command',[AddCommandController::class, 'store'])->name('store');
    });

    Route::group([
        "prefix" => "edit",
        "as" => "edit."
    
    ], function(){
            Route::get('/edit_profil', Editer::class, 'index')->name('profile');
    });

    Route::group([
        "prefix" => "editpassword",
        "as" => "editpassword."
    
    ], function(){
            Route::get('/edit_password', EditPasswordController::class, 'index')->name('password');
    });

    Route::group([
        "prefix" => "contactclient",
        "as" => "contactclient."
    
    ], function(){
            Route::get('/contact_us', ContactController::class, 'index')->name('contact');
    });

    Route::group([
        "prefix" => "messages",
        "as" => "messages."
    
    ], function(){
            Route::get('/messages', MessagesController::class, 'index')->name('list_messages');
    });
});

// Le groupe des routes relatives uniquement aux conducteurs
Route::group([
    "middleware" => ["auth", "auth.conducteur"],
    "as" => "conducteur."

], function(){

    Route::group([
        "prefix" => "edition",
        "as" => "edition."
    
    ], function(){
            Route::get('/edit_profil', Editer::class, 'index')->name('profile');
    });

    Route::group([
        "prefix" => "editionpassword",
        "as" => "editionpassword."
    
    ], function(){
            Route::get('/edit_password', EditPasswordController::class, 'index')->name('password');
    });

    Route::group([
        "prefix" => "contactconducteur",
        "as" => "contactconducteur."
    
    ], function(){
            Route::get('/contact_us', ContactController::class, 'index')->name('contact');
    });

    Route::group([
        "prefix" => "current",
        "as" => "current."
    
    ], function(){
            Route::get('/current_position', CurrentPosition::class, 'index')->name('view');
            Route::post('/current_position',[CurrentPosition::class, 'store'])->name('position');
    });

    Route::group([
        "prefix" => "planning",
        "as" => "planning."
    
    ], function(){
            Route::get('/planning_commande', PlanningController::class, 'index')->name('commande');
    });

    Route::group([
        "prefix" => "road",
        "as" => "road."
    
    ], function(){
            Route::get('/road_commande', RoadController::class, 'index')->name('commande');
    });
});





