<div>
    <x-filament::section>
        <form wire:submit="create">
            {{ $this->form }}
            <button type="submit">
                Submit
            </button>
        </form> 

        <x-filament-actions::modals />
    </x-filament::section>
</div>
