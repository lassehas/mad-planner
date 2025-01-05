<div>
    @foreach ($ingredients as $ingredient)
        <div>
            <div>
                {{ $ingredient->name }} ({{ $ingredient->price }} kr.)
                @if (auth()->user()->find_suiteable_household() != null)
                    <button wire:click="add_to_buy_list({{ $ingredient->id }})">Tilføj til indkøbsliste</button>
                @endif
                <button wire:click="edit_ingredient({{ $ingredient->id }})">Ændre</button>
            </div>
        </div>
    @endforeach
</div>
