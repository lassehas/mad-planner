<?php

namespace App\Livewire\Navigation\List;

use Livewire\Component;

class WeekPlans extends Component
{
    public $week_plans = [];
    public function mount($household_id)
    {
        $household = \App\Models\HouseHold::find($household_id);
        if (!$household->has_access(auth()->user())) {
            return;
        }
        $weekplans = \App\Models\WeekPlan::query()->where('house_hold_id', $household->id)->get();
        $current_week_plan = $weekplans->filter(fn($weekplan) => $weekplan->name == $this->week_plan_name())->first();
        if ($current_week_plan == null) {
            $current_week_plan = \App\Models\WeekPlan::updateOrCreate([
                'house_hold_id' => $household->id,
                'name' => $this->week_plan_name(),
            ], [
                'start_date' => now()->startOfWeek(),
                'end_date' => now()->endOfWeek(),
            ]);
        }
        $weekplans = \App\Models\WeekPlan::query()->where('house_hold_id', $household->id)->get();
        $this->week_plans = $weekplans;
    }
    public function render()
    {
        return view('livewire.navigation.list.week-plans');
    }

    public function week_plan_name()
    {
        $year = now()->year;
        $week = now()->weekOfYear;
        return "Uge $week - $year";
    }

    public function show($week_plan_id)
    {
        return redirect()->route('edit.week-plan', ['week_plan_id' => $week_plan_id]);
    }
}
