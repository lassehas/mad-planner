<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredient extends Model
{
    protected $fillable = ['name', 'price', 'quantity', 'unit_id'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'ingredient_dish');
    }

    public function unit()
    {
        return $this->BelongsTo(Unit::class);
    }

    public function formatted_text()
    {
        return "{$this->name} - {$this->quantity} {$this->unit->name}";
    }

    public function formatted_text_with_price()
    {
        return "{$this->name} - {$this->quantity} {$this->unit->name} - {$this->price} kr.";
    }
}
