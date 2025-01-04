<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'creation'], function () {
        Route::get('unit', \App\Livewire\Create\Unit::class)->name('creation.unit');
        Route::get('ingredient', \App\Livewire\Create\Ingredient::class)->name('creation.ingredient');
        Route::get('dish', \App\Livewire\Create\Dish::class)->name('creation.dish');
    });

    Route::group(['prefix' => 'edit'], function () {
        Route::get('dish/{dish_id}', \App\Livewire\Edit\Dish::class)->name('edit.dish');
        Route::get('week-plan/{week_plan_id}', \App\Livewire\Edit\WeekPlan::class)->name('edit.week-plan');
    });

    Route::get('/', \App\Livewire\Navigation\Home::class)->name('home');

    Route::group(['prefix' => 'list'], function () {
        Route::get('dishes', \App\Livewire\Navigation\List\Dishes::class)->name('list.dishes');
        Route::get('buy-items/{household_id}', \App\Livewire\Navigation\List\BuyItems::class)->name('list.buy-items');
        Route::get('week-plans/{household_id}', \App\Livewire\Navigation\List\WeekPlans::class)->name('list.week-plans');
    });
});
