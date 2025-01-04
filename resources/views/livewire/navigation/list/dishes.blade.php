<div>
    @foreach ($dishes as $dish)
        <div>
            <div>
                {{ $dish->name }} {{ $dish->rating }}  {{ $dish->price }} kr.
                @if (auth()->user()->find_suiteable_household() != null)
                    <button wire:click="add_to_buy_list({{ $dish->id }})">Add to buy list</button>
                @endif
                <button wire:click="edit_dish({{ $dish->id }})">Edit</button>
            </div>
        </div>
    @endforeach
</div>
