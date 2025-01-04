<div class="p-6">
    <x-filament::section>
        <form wire:submit="create">
            {{ $this->form }}
            <button type="submit" class="text-black dark:text-white mt-5">
                Opret
            </button>
        </form> 

        <x-filament-actions::modals />
    </x-filament::section>
</div>