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
</div>
