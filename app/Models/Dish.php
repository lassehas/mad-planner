<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = ['name', 'price', 'url', 'rating', 'description'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_dish')
            ->using(IngredientDish::class);
    }

    public function add_ingredient(\App\Models\Ingredient $ingredient)
    {
        $this->ingredients()->syncWithoutDetaching([
            $ingredient->id 
        ]);
        $this->update_total_price();
    }

    public function add_ingredients($ingredients)
    {
        foreach ($ingredients as $ingredient){
            $this->ingredients()->syncWithoutDetaching([
                $ingredient->id
            ]);
        }
        $this->update_total_price();
    }

    public function remove_ingredient($ingredient_id)
    {
        $this->ingredients()->detach([
            $ingredient_id
        ]);
        $this->update_total_price();
    }

    public function update_total_price()
    {
        if ($this->ingredients->isEmpty()){
            $this->price = 0;
            $this->save();
            return;
        }
        $this->price = $this->ingredients->sum('price');
        $this->save();
    }
}
