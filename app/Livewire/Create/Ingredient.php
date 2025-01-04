<?php

namespace App\Livewire\Create;

use App\Models\Ingredient as ModelsIngredient;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;


class Ingredient extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required(),
                TextInput::make('quantity')
                    ->label('Quantity')
                    ->required(),
                Select::make('unit_id')
                    ->label('Unit')
                    ->required()
                    ->options(fn() => \App\Models\Unit::all()->mapWithKeys(fn($model) => [$model->id => $model->name])),
            ])->columns(2)->statePath('data');
    }

    public function render()
    {
        return view('livewire.create.ingredient');
    }

    public function create()
    {
        if (!isset($this->data['name'], $this->data['price'], $this->data['quantity'], $this->data['unit_id'])) {
            return;
        }

        $ingredient = \App\Models\Ingredient::updateOrCreate([
            'name' => $this->data['name'],
            'quantity' => $this->data['quantity'],
            'unit_id' => $this->data['unit_id'],
        ], [
            'price' => $this->data['price'],
        ]);
        return redirect()->route('creation.ingredient');
    }
}
