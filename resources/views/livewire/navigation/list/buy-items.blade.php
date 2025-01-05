<div>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: left; width: 45%;">Navn</th>
                <th style="text-align: left; width: 25%;">Mængde</th>
                <th style="text-align: left; width: 20%;">Pris</th>
                <th style="text-align: right; width: 10%;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->ingredient->name }}</td>
                    <td>{{ $item->ingredient->quantity }} {{ $item->ingredient->unit->name }}</td>
                    <td>{{ $item->ingredient->price }} kr.</td>
                    <td style="text-align: right;">
                        <button wire:click="remove({{ $item->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                              </svg>                              
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
