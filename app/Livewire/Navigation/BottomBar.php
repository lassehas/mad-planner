<?php

namespace App\Livewire\Navigation\UI;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class BottomBar extends Component
{

    public $current_url;

    public function mount($current_url)
    {
        $this->current_url = $current_url;
    }

    public function render()
    {

        return view('livewire.navigation.bottom-bar');
    }

    public function back()
    {
        $url = $this->current_url;
        if ($url == null) {
            return redirect()->route('home');
        }
        if (\Str::contains($url, 'creations')){
            return redirect()->route('home');
        }
        if (\Str::contains($url, 'edit/dish/')) {
            return redirect()->route('list.dishes');
        }
        if (\Str::contains($url, 'edit/ingredient/')) {
            return redirect()->route('list.ingredients');
        }
        if (\Str::contains($url, 'edit/week-plan/')) {
            return redirect()->route('list.week-plans', ['household_id' => auth()->user()->find_suiteable_household()->id]);
        }
        if (\Str::contains($url, ['creation/unit', 'creation/ingredient', 'creation/dish'])){
            return redirect()->route('creations');
        }
        if (\Str::contains($url, ['list/week-plans/', 'list/ingredients', 'list/buy-items/', 'list/dishes'])) {
            return redirect()->route('home');
        }
    }

    public function current_week_plan()
    {
        $household = auth()->user()->find_suiteable_household();
        $week_plan = \App\Models\WeekPlan::query()->where('house_hold_id', $household->id)
            ->where('name', $this->week_plan_name())->first();
        if ($week_plan == null) {
            $week_plan = \App\Models\WeekPlan::updateOrCreate([
                'house_hold_id' => $household->id,
                'name' => $this->week_plan_name(),
            ], [
                'start_date' => now()->startOfWeek(),
                'end_date' => now()->endOfWeek(),
            ]);
        }
        return redirect()->route('edit.week-plan', ['week_plan_id' => $week_plan->id]);
    }

    public function buy_list()
    {
        $household = auth()->user()->find_suiteable_household();
        return redirect()->route('list.buy-items', ['household_id' => $household->id]);
    }

    public function week_plan_name()
    {
        $year = now()->year;
        $week = now()->weekOfYear;
        return "Uge $week - $year";
    }
}
