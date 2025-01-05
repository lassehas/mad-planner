<?php

namespace App\Livewire\Navigation;

use Livewire\Component;

class Home extends Component
{
    public $household;

    public function mount()
    {
        $user = auth()->user();
        $this->household = $user->find_suiteable_household();
    }

    public function render()
    {
        return view('livewire.navigation.home');
    }

    public function list_creations()
    {
        return redirect()->route('creations');
    }

    public function list_dishes()
    {
        return redirect()->route('list.dishes');
    }

    public function list_buy_items()
    {
        if ($this->household == null){
            return;
        }
        return redirect()->route('list.buy-items', ['household_id' => $this->household->id]);
    }

    public function list_week_plans()
    {
        if ($this->household == null){
            return;
        }
        return redirect()->route('list.week-plans', ['household_id' => $this->household->id]);
    }

    public function list_ingredients()
    {
        return redirect()->route('list.ingredients');
    }
}
