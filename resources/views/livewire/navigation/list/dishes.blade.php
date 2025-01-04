<div>
    @foreach ($dishes as $dish)
        <div>
            <div>
                {{ $dish->name }} ({{ $dish->price }} kr.)
                @if (auth()->user()->find_suiteable_household() != null)
                    <button wire:click="add_to_buy_list({{ $dish->id }})">Tilføj til indkøbsliste</button>
                @endif
                <button wire:click="edit_dish({{ $dish->id }})">Ændre</button>
            </div>
        </div>
    @endforeach
</div>
