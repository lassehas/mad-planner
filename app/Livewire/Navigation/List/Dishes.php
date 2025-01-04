<?php

namespace App\Livewire\Navigation\List;

use Livewire\Component;

class Dishes extends Component
{

    public $dishes = [];

    public function mount()
    {
        $this->dishes = \App\Models\Dish::all();
    }

    public function render()
    {
        return view('livewire.navigation.list.dishes');
    }

    public function edit_dish($dish_id)
    {
        return redirect()->route('edit.dish', ['dish_id' => $dish_id]);
    }

    public function add_to_buy_list($dish_id)
    {
        $dish = $this->dishes->find($dish_id);
        $user = auth()->user();
        $household = $user->find_suiteable_household();
        $household->add_dish_to_buy_list($dish);
    }
}
