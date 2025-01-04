<?php

namespace App\Livewire\Navigation;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.navigation.home');
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

    public function list_dishes()
    {
        return redirect()->route('list.dishes');
    }

    public function list_buy_items()
    {
        return redirect()->route('list.buy-items', ['household_id' => auth()->user()->find_suiteable_household()->id]);
    }

    public function list_week_plans()
    {
        return redirect()->route('list.week-plans', ['household_id' => auth()->user()->find_suiteable_household()->id]);
    }
}
