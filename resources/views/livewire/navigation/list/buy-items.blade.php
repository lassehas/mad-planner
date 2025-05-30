<div class="px-1 pt-1 pb-20">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr class="border-b-2">
                <th style="text-align: left; width: 30%;">Navn</th>
                <th style="text-align: left; width: 25%;">Mængde</th>
                <th style="text-align: left; width: 20%;">Pris</th>
                <th class="h-8" style="text-align: right; width: 25%;">
                    @if (count($items) > 0 && !$this->is_buy_list_purchased())
                        <button wire:click="purchase_all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                            </svg>
                        </button>
                    @endif
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    @php
                        // $item = $items->where('ingredient_id', $key)->first();
                        // if ($item == null){
                        //     continue;
                        // }
                        $is_purchased = $item->is_purchased() ? 'line-through' : '';
                    @endphp
                    <td class="{{ $is_purchased }} flex items-center">
                        @if ($item->ingredient->category != null && $item->ingredient->category->icon != null)
                            @svg($item->ingredient->category->icon, 'w-4 h-4')
                        @endif
                        {{ $item->ingredient->name }}
                    </td>
                    <td class="{{ $is_purchased }}"">{{ $item->ingredient->quantity }}
                        {{ $item->ingredient->unit->name }}</td>
                    <td class="{{ $is_purchased }}"">{{ $item->ingredient->price }} kr.</td>
                    <td style="text-align: right;">
                        @if (!$item->is_purchased())
                            <button wire:click="open_modal({{ $item->ingredient_id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-6">
                                    <!-- Outer Rounded Rectangle -->
                                    <rect x="3" y="3" width="18" height="18" rx="4" ry="4"></rect>

                                    <!-- Minus (-) Symbol -->
                                    <line x1="7" y1="12" x2="17" y2="12"></line>

                                    <!-- Slash (/) to Represent "+/-" -->
                                    <line x1="9" y1="16" x2="15" y2="8"></line>
                                </svg>
                            </button>
                            <button wire:click="edit({{ $item->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 3 21 9 9 21 3 21 3 15 15 3Z" />
                                </svg>
                            </button>
                            <button wire:click="purchase({{ $item->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                        @else
                            <button wire:click="remove({{ $item->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                            <button wire:click="restore({{ $item->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                </svg>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr class="border-t-2">
                <td></td>
                <td></td>
                <td class="h-8 font-bold">{{ $this->total_price() }} kr.</td>
                <td style="text-align: right;">
                    @if ($this->is_buy_list_purchased())
                        <button wire:click="remove_all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <div>
        @if ($show_modal)
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                    <h2 class="text-lg font-semibold mb-4">Modify Item</h2>

                    <!-- Quantity Controls -->
                    <div class="flex items-center justify-between">
                        <button wire:click="decrement" class="px-3 py-2 bg-gray-200 rounded-full">-</button>
                        <input type="number" wire:model="quantity" class="text-center border rounded w-16"
                            min="1">
                        <button wire:click="increment" class="px-3 py-2 bg-gray-200 rounded-full">+</button>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button wire:click="close_modal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                        <button wire:click="save_modal" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="fixed bottom-12 right-3">
        <div class="bg-green-500 text-white p-2 rounded-full shadow-lg flex justify-center items-center">
            {{ $this->addBuy }}
        </div>
        <x-filament-actions::modals />
    </div>
</div>
