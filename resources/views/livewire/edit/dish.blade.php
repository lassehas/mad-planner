<div class="p-6">
    <x-filament::section>
        <form wire:submit="update">
            {{ $this->form }}
            <button type="submit" class="text-black dark:text-white mt-5">
                Update
            </button>
        </form> 

        <x-filament-actions::modals />
    </x-filament::section>
    <x-filament::section>
        @livewire('components.add-ingredient', ['dish_id' => $dish->id])

        <h2 class="text-black dark:text-white">Ingredients</h2>
        @foreach ($dish->ingredients as $ingredient)
            <div class="text-black dark:text-white">
                <span>{{ $ingredient->formatted_text() }}</span>
                <button wire:click="remove({{ $ingredient->id }})">Remove</button>
            </div>
        @endforeach
    </x-filament::section>
</div>