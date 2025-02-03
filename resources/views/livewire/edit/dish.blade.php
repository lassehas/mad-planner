<div class="p-6">
    <x-filament::section>
        <form wire:submit="update">
            {{ $this->form }}
            <button type="submit" class="text-black dark:text-white mt-5 px-4 py-1 border rounded-lg bg-green-500">
                Opdatere
            </button>
        </form> 

        <x-filament-actions::modals />
    </x-filament::section>
    <x-filament::section class="mt-4">
        @livewire('components.add-ingredient', ['dish_id' => $dish->id])
        
        <h2 class="text-black dark:text-white">Varer</h2>
        @foreach ($dish->ingredients as $ingredient)
            <div class="text-black dark:text-white">
                <span>{{ $ingredient->formatted_text() }}</span>
                <button wire:click="remove({{ $ingredient->id }})">Fjern</button>
            </div>
        @endforeach
    </x-filament::section>
</div>