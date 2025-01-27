<?php

namespace App\Livewire\Navigation\List;

use Livewire\Component;

class BuyItems extends Component
{
    public $items = [];
    public $items_combined = [];
    public $household = null;

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
        $item = $this->items->firstWhere('id',$item_id);
        $item->delete();
        $this->fetch_items();
    }

    public function purchase($item_id)
    {
        $item = $this->items->firstWhere('id',$item_id);
        $item->update([
            'status' => 'purchased'
        ]);
        $this->fetch_items();
    }

    public function fetch_items()
    {
        $items = \App\Models\BuyItem::where('house_hold_id', $this->household->id)->get();

        $uniqueItems = collect();

        foreach ($items as $item) {
            $existingItem = $uniqueItems->firstWhere('ingredient_id', $item->ingredient_id);

            if ($existingItem) {
                $existingItem->ingredient->quantity += $item->ingredient->quantity;
                $existingItem->ingredient->price += $item->ingredient->price;
                $item->status = 'purchased';
                $item->save();
            } else {
                $uniqueItems->push($item);
            }
        }
        $this->items = $uniqueItems->sortBy(function ($item){
            if (!isset($item->ingredient->category)){
                return 9899;
            }
            return $item->ingredient->category->sort_order;
        })->sortBy('status');
    }

    public function restore($item_id)
    {
        $item = $this->items->firstWhere('id',$item_id);
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
}
