<div>
    <div>

        <button wire:click="create_unit">Opret Enhed</button>
    </div>
    <div>
        <button wire:click="create_ingredient">Opret Ingrediens</button>
    </div>
    <div>
        <button wire:click="create_dish">Opret ret</button>
    </div>
    <div>
        <button wire:click="list_dishes">Vis retter</button>
    </div>
    @if (auth()->user()->find_suiteable_household() != null)
        <div>
            <button wire:click="list_buy_items">Vis indkøbslisten</button>
        </div>
        <div>
            <button wire:click="list_week_plans">Vis ugeplan</button>
        </div>
    @endif
</div>
