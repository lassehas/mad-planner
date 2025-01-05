<?php

namespace App\Livewire\Navigation\List;

use Livewire\Component;

class WeekPlans extends Component
{
    public $week_plans = [];
    public $household = null;
    public function mount($household_id)
    {
        $household = \App\Models\HouseHold::find($household_id);
        if ($household == null) {
            return;
        }
        $this->household = $household;
        if (!$household->has_access(auth()->user())) {
            return;
        }
        $weekplans = \App\Models\WeekPlan::query()->where('house_hold_id', $household->id)->orderByDesc('end_date')->get();
        $current_week_plan = $weekplans->filter(fn($weekplan) => $weekplan->name == $this->week_plan_name())->first();
        if ($current_week_plan == null) {
            $current_week_plan = \App\Models\WeekPlan::updateOrCreate([
                'house_hold_id' => $household->id,
                'name' => $this->week_plan_name(),
            ], [
                'start_date' => now()->startOfWeek(),
                'end_date' => now()->endOfWeek(),
            ]);
            $weekplans = \App\Models\WeekPlan::query()->where('house_hold_id', $household->id)->orderByDesc('created_at')->get();
        }
        $this->week_plans = $weekplans;
    }
    public function render()
    {
        return view('livewire.navigation.list.week-plans');
    }

    public function week_plan_name($date = null)
    {
        if ($date !== null) {
            $year = $date->year;
            $week = $date->weekOfYear;
            return "Uge $week - $year";
        }
        $year = now()->year;
        $week = now()->weekOfYear;
        return "Uge $week - $year";
    }

    public function show($week_plan_id)
    {
        return redirect()->route('edit.week-plan', ['week_plan_id' => $week_plan_id]);
    }

    public function create()
    {
        $week = $this->week_plans->first()->end_date ?? null;
        $week_number = $week->weekOfYear;
        $start_date = now()->setISODate(now()->year, $week_number + 1)->startOfWeek();
        $end_date = now()->setISODate(now()->year, $week_number + 1)->endOfWeek();
        $week_plan = \App\Models\WeekPlan::updateOrCreate([
            'house_hold_id' => $this->household->id,
            'name' => $this->week_plan_name(now()->setISODate(now()->year, $week_number + 1)),
        ], [
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
        return redirect()->route('list.week-plans', ['household_id' => $this->household->id]);
    }
}
