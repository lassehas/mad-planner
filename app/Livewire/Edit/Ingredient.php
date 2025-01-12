<?php

namespace App\Livewire\Edit;

use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;


class Ingredient extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    public $ingredient = null;

    public function mount($ingredient_id)
    {
        $ingredient = \App\Models\Ingredient::find($ingredient_id);
        if ($ingredient == null) {
            return;
        }
        $this->ingredient = $ingredient;
        $this->form->fill($ingredient->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Navn'),
                TextInput::make('quantity')
                    ->label('Mængde/Antal'),
                Select::make('unit_id')
                    ->label('Enhed')
                    ->options(fn() => \App\Models\Unit::all()->mapWithKeys(fn($model) => [$model->id => $model->name])),
                TextInput::make('price')
                    ->label('Pris')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ])->columns(2)->statePath('data');
    }

    public function render()
    {
        return view('livewire.edit.ingredient');
    }

    public function update()
    {
        $this->validate();
        $this->ingredient->update($this->data);
    }
}
