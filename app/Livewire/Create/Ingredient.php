<?php

namespace App\Livewire\Create;

use App\Models\Ingredient as ModelsIngredient;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
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
                    ->label('Navn')
                    ->required(),
                TextInput::make('price')
                    ->label('Pris')
                    ->numeric()
                    ->default(0)
                    ->required(),
                TextInput::make('quantity')
                    ->label('Mængde/Antal')
                    ->required(),
                Select::make('unit_id')
                    ->label('Enhed')
                    ->required()
                    ->options(fn() => \App\Models\Unit::all()->mapWithKeys(fn($model) => [$model->id => $model->name])),
                Select::make('category_id')
                    ->label('Kategori')
                    ->searchable()
                    ->options(fn() => \App\Models\IngredientCategory::all()->mapWithKeys(fn($model) => [$model->id => $model->name])),
            ])->columns(2)->statePath('data');
    }

    public function render()
    {
        return view('livewire.create.ingredient');
    }

    public function create()
    {
        $ingredient_name = $this->data['name'];
        $quantity = $this->data['quantity'];
        $unit_id = $this->data['unit_id'];
        if (!isset($ingredient_name, $this->data['price'], $quantity, $unit_id)) {
            return;
        }

        $ingredient = \App\Models\Ingredient::query()->whereName($ingredient_name)->whereQuantity($quantity)->where('unit_id', $unit_id)->first();
        if ($ingredient) {
            Notification::make('exists')
                ->title('Varen eksisterer allerede')
                ->warning()
                ->send();
            return;
        }

        $ingredient = \App\Models\Ingredient::updateOrCreate([
            'name' => $this->data['name'],
            'quantity' => $this->data['quantity'],
            'unit_id' => $this->data['unit_id'],
        ], [
            'price' => $this->data['price'],
        ]);
        Notification::make('success')
            ->title('Varen er blevet oprettet')
            ->send();
        return redirect()->route('creation.ingredient');
    }
}
