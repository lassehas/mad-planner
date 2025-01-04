<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserHouseHold extends Pivot
{
    protected $table = 'user_house_hold';
    protected $fillable = ['user_id', 'household_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function household()
    {
        return $this->belongsTo(Household::class);
    }
}
