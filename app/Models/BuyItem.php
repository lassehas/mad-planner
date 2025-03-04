<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyItem extends Model
{
    protected $fillable = ['house_hold_id', 'ingredient_id', 'status'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id', 'id');
    }

    public function houseHold()
    {
        return $this->belongsTo(HouseHold::class, 'id', 'house_hold_id');
    }

    public function is_purchased()
    {
        return $this->status === 'purchased';
    }
}
