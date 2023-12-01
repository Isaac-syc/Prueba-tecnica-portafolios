<?php

namespace App\Livewire;

use App\Models\Portafolio;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreatePortafolio extends Component
{
    public $title;
    public $description;
    public $image;
    public $public = false;

    use WithFileUploads;

    public function createPortafolio()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);


        $imageName = time() . '.' . $this->image->getClientOriginalExtension();
        $this->image->storeAs('public/images', $imageName);

        Portafolio::create([
            'title' => $this->title,
            'description' => $this->description,
            'image_name' => $imageName,
            'public' => $this->public,
            'user_id' => auth()->user()->id,
        ]);

        session()->flash('message', '¡Portafolio creado con éxito!');

        return redirect()->route('portafolio.index');
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function render()
    {
        return view('livewire.create-portafolio')->extends('layouts.main');
    }
}
