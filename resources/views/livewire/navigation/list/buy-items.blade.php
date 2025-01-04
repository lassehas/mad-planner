<div>
    @foreach ($items as $item)
        <div>
            {{ $item->ingredient->formatted_text_with_price() }} 
            <button wire:click="remove({{ $item->id }})">Fjern</button>
        </div>
    @endforeach
    <div>Totalt pris: {{ $this->total_price() }} kr.</div>
</div>
