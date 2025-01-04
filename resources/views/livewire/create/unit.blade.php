<div>
    <x-filament::section>
        <form wire:submit="create">
            {{ $this->form }}
            <button type="submit">
                Create
            </button>
        </form> 

        <x-filament-actions::modals />
    </x-filament::section>
</div>