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
</div>
