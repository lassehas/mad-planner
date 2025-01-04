<?php

namespace App\Console\Commands;

use App\Models\Dish;
use App\Models\HouseHold;
use App\Models\Ingredient;
use App\Models\Unit;
use App\Models\WeekPlan;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //what day is 1
        $user = \App\Models\User::first();
        dump($user->household_in);
        $this->add_user_to_house_hold($user);
    }

    public function add_user_to_house_hold($user)
    {
        $household = \App\Models\HouseHold::find(2);
        dump($household != null);
        $household->add_user($user);
    }

    public function create_house_hold()
    {

        $user = \App\Models\User::first();
        dump($user != null);

        $household = HouseHold::updateOrCreate([
            'name' => 'Household 1',
            'owner_id' => $user->id
        ]);
        dump($household != null);

        $week_plan = WeekPlan::updateOrCreate([
            'name' => 'Uge 1',
            'house_hold_id' => $household->id
        ], [
            'start_date' => now(),
            'end_date' => now()->addWeek()
        ]);
        dump($week_plan != null);
    }

    public function create_ingredient_dish()
    {
        $unit = Unit::updateOrCreate(['name' => 'gram']);
        $ingredient = Ingredient::updateOrCreate(['name' => 'flour'], ['price' => 10.99]);

        $quantity = 500;

        //create ingredient_dish record with quantity

        $dish = Dish::updateOrCreate(
            [
                'name' => 'Pancakes',
            ],
            [
                'price' => 5.99,
                'url' => 'https://pancakes.com',
                'rating' => 5,
            ]
        );

        $dish->ingredients()->syncWithoutDetaching([
            $ingredient->id => [
                'quantity' => $quantity,
                'unit_id' => $unit->id, // Assuming you track the unit in the pivot table
            ],
        ]);
    }
}
