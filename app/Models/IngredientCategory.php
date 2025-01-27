<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model
{
    protected $fillable = ['name', 'sort_order', 'icon'];
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
