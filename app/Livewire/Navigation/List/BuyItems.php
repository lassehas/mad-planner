<?php

namespace App\Livewire\Navigation\List;

use Livewire\Component;

class BuyItems extends Component
{
    public $items = [];

    public function mount($household_id)
    {
        $household = \App\Models\HouseHold::find($household_id);
        if (!$household->has_access(auth()->user())){
            return;
        }
        $this->items = \App\Models\BuyItem::where('house_hold_id', $household->id)->get();
    }
    public function render()
    {
        return view('livewire.navigation.list.buy-items');
    }

    public function remove($item_id)
    {
        $item = $this->items->find($item_id);
        $item->delete();
        $this->items = \App\Models\BuyItem::where('house_hold_id', $item->house_hold_id)->get();
    }

    public function purchase($item_id)
    {
        $item = $this->items->find($item_id);
        $item->update([
            'status' => 'purchased'
        ]);
        $this->items = \App\Models\BuyItem::where('house_hold_id', $item->house_hold_id)->get();
    }

    public function restore($item_id)
    {
        $item = $this->items->find($item_id);
        $item->update([
            'status' => null
        ]);
        $this->items = \App\Models\BuyItem::where('house_hold_id', $item->house_hold_id)->get();
    }

    public function remove_all()
    {
        foreach ($this->items as $item){
            $item->delete();
        }
        $this->items = [];
    }

    public function purchase_all()
    {
        foreach ($this->items as $item){
            $item->update([
                'status' => 'purchased'
            ]);
        }
        $this->items = \App\Models\BuyItem::where('house_hold_id', $this->items[0]->house_hold_id)->get();
    }

    public function is_buy_list_purchased()
    {
        if (count($this->items) == 0){
            return false;
        }

        foreach ($this->items as $item){
            if ($item->status != 'purchased'){
                return false;
            }
        }
        return true;
    }

    public function total_price()
    {
        $total = 0;
        foreach ($this->items as $item){
            $total += $item->ingredient->price;
        }
        return $total;
    }
}
