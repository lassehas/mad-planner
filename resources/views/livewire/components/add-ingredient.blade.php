<div>
    <h2 class="text-black dark:text-white">Add Ingredient</h2>
    <form wire:submit="add_ingredient">
        {{ $this->form }}
        <button type="submit" class="text-black dark:text-white mt-1 mb-5">
            Add
        </button>
    </form>
</div>
