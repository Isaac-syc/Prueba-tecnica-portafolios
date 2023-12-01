<?php

namespace App\Livewire;

use App\Models\Portafolio;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditPortafolio extends Component
{

    public $portafolio, $title, $description, $public, $image_name;
    public $newImage;
    public $confirmingDelete = false;

    use WithFileUploads;

    public function mount($id)
    {
        $this->portafolio = Portafolio::find($id);

        $this->title = $this->portafolio->title;
        $this->description = $this->portafolio->description;
        $this->public = $this->portafolio->public;
        $this->image_name = $this->portafolio->image_name;
    }

    public function confirmDelete()
    {
        $this->confirmingDelete = true;
    }

    public function deletePortafolio()
    {
        $this->portafolio->delete();
        return redirect()->route('portafolio.index');
    }

    public function updatePortafolio()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'newImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->portafolio->title = $this->title;
        $this->portafolio->description = $this->description;
        $this->portafolio->public = $this->public;


        if ($this->newImage) {
            $imageName = time() . '.' . $this->newImage->getClientOriginalExtension();
            $this->newImage->storeAs('public/images', $imageName);
            $this->portafolio->image_name = $imageName;
        }

        $this->portafolio->save();


        session()->flash('message', '¡Portafolio creado con éxito!');
        return redirect()->route('portafolio.index');
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function render()
    {
        return view('livewire.edit-portafolio')->extends('layouts.main');
    }
}
