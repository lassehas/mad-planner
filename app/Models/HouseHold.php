<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseHold extends Model
{
    protected $fillable = [
        'name',
        'owner_id'
    ];

    public function week_plans()
    {
        return $this->hasMany(WeekPlan::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_house_hold')
            ->using(UserHouseHold::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'id', 'owner_id');
    }

    public function has_access(\App\Models\User $user)
    {
        if ($this->owner_id === $user->id) {
            return true;
        }
        return $this->users->contains($user);
    }

    public function add_user(\App\Models\User $user)
    {
        $this->users()->syncWithoutDetaching([
            $user->id
        ]);
    }

    public function buy_items()
    {
        return $this->hasMany(BuyItem::class);
    }

    public function add_dish_to_buy_list(\App\Models\Dish $dish)
    {
        foreach ($dish->ingredients as $ingredient) {
            $this->buy_items()->create([
                'ingredient_id' => $ingredient->id
            ]);
        }
    }
}
