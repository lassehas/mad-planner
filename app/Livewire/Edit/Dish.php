<?php

namespace App\Livewire\Edit;

use Filament\Forms\Components\Actions\Action;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

class Dish extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    public ?array $add_data = [];
    public $dish = null;

    public function mount($dish_id): void
    {
        $dish = \App\Models\Dish::find($dish_id);
        if ($dish == null) {
            return;
        }
        $this->form->fill($dish->toArray());
        $this->dish = $dish;
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Navn')
                    ->disabled(),
                TextInput::make('price')
                    ->disabled()
                    ->label('Pris')
                    ->suffix('Kr.'),
                TextInput::make('url')
                    ->label('Link')
                    ->suffixAction(
                        Action::make('open')
                            ->icon('heroicon-o-arrow-up-right')
                            ->openUrlInNewTab()
                            ->url(function (){
                                return $this->data['url'];
                            })
                    ),
                TextInput::make('rating')
                    ->label('Rating')
                    ->maxValue(10)
                    ->numeric(),
                Textarea::make('description')
                    ->label('Beskrivelse')
                    ->columnSpanFull(),
            ])->columns(2)->statePath('data');
    }
    public function render()
    {
        return view('livewire.edit.dish');
    }

    public function update()
    {
        if ($this->dish == null) {
            return;
        }
        $this->dish->update($this->data);
    }

    public function remove($ingredient_id)
    {
        if ($this->dish == null) {
            return;
        }
        $this->dish->remove_ingredient($ingredient_id);
        return redirect()->route('edit.dish', ['dish_id' => $this->dish->id]);
    }
}
