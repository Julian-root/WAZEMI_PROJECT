<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Livewire\WithPagination;


class MessagesController extends Component
{
    // Gestion de la pagination au niveau du Dashboard
    use WithPagination;

    public $currentPage = PAGELIST;
    
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        
        return view('livewire.messages.index', [
            "messages" => Contact::latest()->paginate(4)
        ])
        ->extends('layouts.master')
        ->section('content');   
    }
}
