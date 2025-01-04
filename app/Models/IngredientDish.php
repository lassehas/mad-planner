<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class IngredientDish extends Pivot
{
    protected $table = 'ingredient_dish';
    protected $fillable = ['ingredient_id', 'dish_id'];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
