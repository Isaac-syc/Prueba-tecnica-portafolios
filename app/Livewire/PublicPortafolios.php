<?php

namespace App\Livewire;

use App\Models\Portafolio;
use Livewire\Component;

class PublicPortafolios extends Component
{
    public $portafolios;
    public $portafolio;
    public $showDescription = false;


    public function mount()
    {
        $this->portafolios = Portafolio::where('public', true)->get();
    }

    public function hover($portafolio)
    {
        $this->portafolio = $portafolio;
        $this->showDescription = true;
    }

    public function leave()
    {
        $this->showDescription = false;
    }

    public function render()
    {
        return view('livewire.public-portafolios')->extends('layouts.app');
    }
}
