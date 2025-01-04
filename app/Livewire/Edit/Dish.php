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
                    ->label('Name')
                    ->disabled(),
                TextInput::make('price')
                    ->disabled()
                    ->suffix('Kr.'),
                TextInput::make('url')
                    ->label('URL')
                    ->suffixAction(
                        Action::make('open')
                            ->icon('heroicon-o-arrow-up-right')
                            ->action(function () {
                                return redirect($this->data['url']);
                            })
                    ),
                TextInput::make('rating')
                    ->label('Rating')
                    ->numeric(),
                Textarea::make('description')
                    ->label('Description')
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
