<div class="p-6">
    <x-filament::section>
        <form wire:submit="update">
            {{ $this->form }}
        </form> 

        <x-filament-actions::modals />
    </x-filament::section>
</div>
