<div>
    <div>

        <button wire:click="create_unit">Create Unit</button>
    </div>
    <div>
        <button wire:click="create_ingredient">Create Ingredient</button>
    </div>
    <div>
        <button wire:click="create_dish">Create Dish</button>
    </div>
    <div>
        <button wire:click="list_dishes">Show dishes</button>
    </div>
    <div>
        <button wire:click="list_buy_items">Show buy items</button>
    </div>
    @if (auth()->user()->find_suiteable_household() != null)
        <div>
            <button wire:click="list_week_plans">Show week plans</button>
        </div>
    @endif
</div>
