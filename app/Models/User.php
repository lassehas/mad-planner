<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function household_owned()
    {
        return $this->hasMany(HouseHold::class, 'owner_id', 'id');
    }

    public function houseHolds()
    {
        return $this->belongsToMany(HouseHold::class, 'user_house_hold')
            ->using(UserHouseHold::class);
    }

    public function find_suiteable_household()
    {
        if ($this->household_owned != null && $this->household_owned->isNotEmpty()){
            return $this->household_owned->first();
        }
        if ($this->houseHolds && $this->houseHolds->isNotEmpty()){
            return $this->houseHolds->first();
        }
        return null;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if (env('APP_ENV') === 'local') {
            return true;

        }
        return str_ends_with($this->email, '@mad-planner.dk');
    }
}
