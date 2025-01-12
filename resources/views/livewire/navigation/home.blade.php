<div class="h-screen flex flex-col justify-center items-center gap-3">
    <div>
        <button wire:click="list_creations" class="w-44 py-2 border-2 rounded-lg">Oprettelser</button>
    </div>
    <div>
        <button wire:click="list_dishes" class="w-44 py-2 border-2 rounded-lg">Vis retter</button>
    </div>
    <div>
        <button wire:click="list_ingredients" class="w-44 py-2 border-2 rounded-lg">Vis varer</button>
    </div>
    @if (auth()->user()->find_suiteable_household() != null)
        <div>
            <button wire:click="list_buy_items" class="w-44 py-2 border-2 rounded-lg">Vis indkøbslisten</button>
        </div>
        <div>
            <button wire:click="list_week_plans" class="w-44 py-2 border-2 rounded-lg">Vis ugeplan</button>
        </div>
    @endif
</div>
