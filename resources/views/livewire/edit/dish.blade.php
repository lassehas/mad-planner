<div>
    <x-filament::section>
        <form wire:submit="update">
            {{ $this->form }}
            <button type="submit">
                Update
            </button>
        </form> 

        <x-filament-actions::modals />
    </x-filament::section>
    <x-filament::section>
        @livewire('components.add-ingredient', ['dish_id' => $dish->id])

        <h2>Ingredients</h2>
        @foreach ($dish->ingredients as $ingredient)
            <div>
                <span>{{ $ingredient->formatted_text() }}</span>
                <button wire:click="remove({{ $ingredient->id }})">Remove</button>
            </div>
        @endforeach
    </x-filament::section>
</div>