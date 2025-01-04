<div>
    @foreach ($items as $item)
        <div>
            {{ $item->ingredient->formatted_text_with_price() }} 
            <button wire:click="remove({{ $item->id }})">Remove</button>
        </div>
    @endforeach
    <div>Totalt pris: {{ $this->total_price() }} kr.</div>
</div>
