<div>
    <x-filament::section>
        <form wire:submit="create">
            {{ $this->form }}
            <button type="submit" class="text-black dark:text-white">
                Create
            </button>
        </form> 

        <x-filament-actions::modals />
    </x-filament::section>
</div>