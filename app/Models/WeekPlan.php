<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeekPlan extends Model
{
    protected $fillable = ['house_hold_id', 'name', 'start_date', 'end_date', 'monday_dish_id', 'tuesday_dish_id', 'wednesday_dish_id', 'thursday_dish_id', 'friday_dish_id', 'saturday_dish_id', 'sunday_dish_id'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function house_hold()
    {
        return $this->belongsTo(HouseHold::class, 'house_hold_id', 'id');
    }

    public function monday_dish()
    {
        return $this->belongsTo(Dish::class, 'monday_dish_id', 'id');
    }

    public function tuesday_dish()
    {
        return $this->belongsTo(Dish::class, 'tuesday_dish_id', 'id');
    }

    public function wednesday_dish()
    {
        return $this->belongsTo(Dish::class, 'wednesday_dish_id', 'id');
    }

    public function thursday_dish()
    {
        return $this->belongsTo(Dish::class, 'thursday_dish_id', 'id');
    }

    public function friday_dish()
    {
        return $this->belongsTo(Dish::class, 'friday_dish_id', 'id');
    }

    public function saturday_dish()
    {
        return $this->belongsTo(Dish::class, 'saturday_dish_id', 'id');
    }

    public function sunday_dish()
    {
        return $this->belongsTo(Dish::class, 'sunday_dish_id', 'id');
    }

    public function dishes()
    {
        $days = ['monday_dish', 'tuesday_dish', 'wednesday_dish', 'thursday_dish', 'friday_dish', 'saturday_dish', 'sunday_dish'];
        return collect($days)->map(function ($day) {
            return $this->$day;
        });
    }
}
