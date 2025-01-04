<?php

namespace App\Livewire\Create;

use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

class Unit extends Component  implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
            ])->statePath('data');
    }

    public function render()
    {
        return view('livewire.create.unit');
    }

    public function create()
    {
        if (!isset($this->data['name'])) {
            return;
        }
        \App\Models\Unit::updateOrCreate($this->data);
        return redirect()->route('creation.unit');
    }
}
