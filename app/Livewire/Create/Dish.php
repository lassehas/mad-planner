<?php

namespace App\Livewire\Create;

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
                TextInput::make('url')
                    ->label('URL'),
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
        return view('livewire.create.dish');
    }

    public function create()
    {
        if (!isset($this->data['name'])) {
            return;
        }
        $dish = \App\Models\Dish::create($this->data);
        return redirect()->route('creation.dish');
    }
}
