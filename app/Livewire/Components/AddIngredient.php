<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

class AddIngredient extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    public $dish = null;
    public function mount($dish_id): void
    {
        $dish = \App\Models\Dish::find($dish_id);
        $this->form->fill();
        $this->dish = $dish;
    }
    public function render()
    {
        return view('livewire.components.add-ingredient');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ingredient')
                    ->label('Vare')
                    ->multiple()
                    ->preload()
                    ->options(\App\Models\Ingredient::all()->mapWithKeys(fn($ingredient) => [$ingredient->id => "{$ingredient->name} {$ingredient->quantity} {$ingredient->unit->name}"]))
            ])->statePath('data');
    }

    public function add_ingredient()
    {
        if ($this->data['ingredient'] == null) {
            return;
        }
        $ingredients = \App\Models\Ingredient::whereIn('id', $this->data['ingredient'])->get();

        if ($ingredients->isEmpty()) {
            return;
        }

        $this->dish->add_ingredients($ingredients);
        $this->dish->update_total_price();
        return redirect()->route('edit.dish', ['dish_id' => $this->dish->id]);
    }
}
