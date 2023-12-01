<?php

namespace App\Livewire;

use App\Models\Portafolio;
use Livewire\Component;

class ShowPortafolio extends Component
{

    public $portafolios;

    public function mount()
    {
        $this->portafolios = Portafolio::where('user_id', auth()->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.show-portafolio')->extends('layouts.main');
    }
}
