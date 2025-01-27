<div>
    <h2 class="text-black dark:text-white">Tilføj varer</h2>
    <form wire:submit="add_ingredient">
        {{ $this->form }}
        <button type="submit" class="text-black dark:text-white mt-5 px-4 py-1 border rounded-lg bg-green-500">
            Add
        </button>
    </form>
</div>
