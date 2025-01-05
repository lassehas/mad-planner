<?php

namespace App\Livewire\Navigation\List;

use Livewire\Component;

class Ingredients extends Component
{

    public $ingredients = [];

    public function mount()
    {
        $this->ingredients = \App\Models\Ingredient::query()->get();
    }

    public function render()
    {
        return view('livewire.navigation.list.ingredients');
    }

    public function edit_ingredient($ingredient_id)
    {
        return redirect()->route('edit.ingredient', ['ingredient_id' => $ingredient_id]);
    }

    public function add_to_buy_list($ingredient_id)
    {
        $ingredient = $this->ingredients->find($ingredient_id);
        $user = auth()->user();
        $household = $user->find_suiteable_household();
        $household->add_ingredient_to_buy_list($ingredient);
    }
}
