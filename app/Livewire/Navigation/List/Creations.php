<?php

namespace App\Livewire\Navigation\List;

use Livewire\Component;

class Creations extends Component
{
    public function render()
    {
        return view('livewire.navigation.list.creations');
    }

    public function create_unit()
    {
        return redirect()->route('creation.unit');
    }

    public function create_ingredient()
    {
        return redirect()->route('creation.ingredient');
    }

    public function create_dish()
    {
        return redirect()->route('creation.dish');
    }
}
