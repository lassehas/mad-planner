<?php

namespace App\Livewire\Navigation\List;

use Livewire\Component;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;

class BuyItems extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;
    public $items = [];
    public $total_items = [];
    public $household = null;
    public $quantity = 1;
    public $show_modal = false;
    public $editing_ingredient_id = null;

    public function mount($household_id)
    {
        $household = \App\Models\HouseHold::find($household_id);
        if (!$household->has_access(auth()->user())) {
            return;
        }
        $this->household = $household;
        $this->fetch_items();
    }
    public function render()
    {
        return view('livewire.navigation.list.buy-items');
    }

    public function remove($item_id)
    {
        $item = $this->items->firstWhere('id', $item_id);
        $item->delete();
        $this->fetch_items();
    }

    public function purchase($item_id)
    {
        $item = $this->items->firstWhere('id', $item_id);
        $item->update([
            'status' => 'purchased'
        ]);
        $this->fetch_items();
    }

    public function fetch_items()
    {
        $items = \App\Models\BuyItem::where('house_hold_id', $this->household->id)->get();
        $this->total_items = $items;
        $uniqueItems = collect();

        foreach ($items as $item) {
            $existingItem = $uniqueItems->filter(fn($i) => $i->ingredient->unit_id == $item->ingredient->unit_id
                && $i->ingredient->name === $item->ingredient->name)->first();

            if ($existingItem) {
                $existingItem->ingredient->quantity += $item->ingredient->quantity;
                $existingItem->ingredient->price += $item->ingredient->price;
                $item->status = 'purchased';
                $item->save();
            } else {
                $uniqueItems->push($item);
            }
        }
        $this->items = $uniqueItems->sortBy(function ($item) {
            if (!isset($item->ingredient->category)) {
                return 9899;
            }
            return $item->ingredient->category->sort_order;
        })->sortBy('status');
    }

    public function edit($item_id)
    {
        $item = $this->items->firstWhere('id', $item_id);
        return redirect()->route('edit.ingredient', ['ingredient_id' => $item->ingredient_id]);
    }

    public function restore($item_id)
    {
        $item = $this->items->firstWhere('id', $item_id);
        $item->update([
            'status' => null
        ]);
        $this->fetch_items();
    }

    public function remove_all()
    {
        foreach ($this->items as $item) {
            $item->delete();
        }
        $this->items = [];
    }

    public function purchase_all()
    {
        foreach ($this->items->filter(fn($it) => $it->status === null) as $item) {
            $item->update([
                'status' => 'purchased'
            ]);
        }
        $this->fetch_items();
    }

    public function is_buy_list_purchased()
    {
        if (count($this->items) == 0) {
            return false;
        }

        foreach ($this->items as $item) {
            if ($item['status'] != 'purchased' || $item->status != 'purchased') {
                return false;
            }
        }
        return true;
    }

    public function total_price()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->ingredient->price;
        }
        return $total;
    }

    public function open_modal($ingredient_id)
    {
        $this->set_quantity($ingredient_id);
        $this->show_modal = true;
        $this->editing_ingredient_id = $ingredient_id;
    }

    public function close_modal()
    {
        $this->show_modal = false;
    }

    public function addBuy(): Action
    {
        return Action::make('addBuy')
            ->icon('heroicon-o-plus-circle')
            ->hiddenLabel()
            ->modalCancelActionLabel('Anullere')
            ->modalSubmitActionLabel('Tilføj')
            ->form([
                Select::make('ingredients')
                    ->multiple()
                    ->required()
                    ->options(\App\Models\Ingredient::all()->mapWithKeys(fn($ingredient) => [$ingredient->id => "{$ingredient->name} {$ingredient->quantity} {$ingredient->unit->name}"])),
            ])
            ->action(function ($data) {
                if ($data['ingredients'] == null) {
                    return;
                }
                foreach ($data['ingredients'] as $ingredient_id) {
                    \App\Models\BuyItem::create([
                        'house_hold_id' => $this->household->id,
                        'ingredient_id' => $ingredient_id,
                        'status' => null
                    ]);
                }
                return redirect()->route('list.buy-items', ['household_id' => $this->household->id]);
            });
    }

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function save_modal()
    {

        $base_quantity = $this->get_quantity_for_ingredient($this->editing_ingredient_id);
        $edited_quantity = $this->quantity;
        $diff = $edited_quantity - $base_quantity;
        if ($diff > 0) {
            for ($i = 0; $i < $diff; $i++) {
                \App\Models\BuyItem::create([
                    'house_hold_id' => $this->household->id,
                    'ingredient_id' => $this->editing_ingredient_id,
                    'status' => 'purchased'
                ]);
            }
        } else {
            $items = $this->total_items->where('ingredient_id', $this->editing_ingredient_id)->where('status', 'purchased')->take(abs($diff));
            foreach ($items as $item) {
                $item->delete();
            }
        }

        return redirect()->route('list.buy-items', ['household_id' => $this->household->id]);
    }

    public function get_quantity_for_ingredient($ingredient_id)
    {
        return $this->total_items->where('ingredient_id', $ingredient_id)->count();
    }

    public function set_quantity($ingredient_id)
    {
        $this->quantity = $this->get_quantity_for_ingredient($ingredient_id);
    }
}
