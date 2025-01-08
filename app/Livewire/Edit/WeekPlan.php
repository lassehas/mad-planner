<?php

namespace App\Livewire\Edit;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;

class WeekPlan extends Component  implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    public $week_plan = null;
    public $household = null;
    public function mount($week_plan_id): void
    {
        $week_plan = \App\Models\WeekPlan::find($week_plan_id);
        if ($week_plan == null) {
            return;
        }
        $this->household = $week_plan->house_hold;
        $data = $week_plan->toArray();
        $data['total_price'] = $week_plan->dishes()->sum('price');
        $this->form->fill($data);
        $this->week_plan = $week_plan;
    }
    public function form(Form $form): Form
    {
        $options = \App\Models\Dish::all()->mapWithKeys(fn($dish) => [$dish->id => "{$dish->name} ({$dish->price} kr.)"]);

        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Navn')
                    ->disabled(),
                Select::make('monday_dish_id')
                    ->label('Mandag ret')
                    ->options($options)
                    ->suffixAction(
                        Action::make('add_monday_dish_to_buy_list')
                            ->label('')
                            ->icon('heroicon-o-plus-circle')
                            ->action(function ($state) {
                                $dish = \App\Models\Dish::find($state);
                                if (!$dish) {
                                    return;
                                }
                                $this->household->add_dish_to_buy_list($dish);
                                // Notification::make('dish_added')
                                //     ->title('Ret tilføjet')
                                //     ->duration(1500)
                                //     ->success()
                                //     ->send();
                            })
                    ),
                Select::make('tuesday_dish_id')
                    ->label('Tirsdag ret')
                    ->options($options)
                    ->suffixAction(
                        Action::make('add_monday_dish_to_buy_list')
                            ->label('')
                            ->icon('heroicon-o-plus-circle')
                            ->action(function ($state) {
                                $dish = \App\Models\Dish::find($state);
                                if (!$dish) {
                                    return;
                                }
                                $this->household->add_dish_to_buy_list($dish);
                                Notification::make('dish_added')
                                    ->title('Ret tilføjet')
                                    ->duration(1500)
                                    ->success()
                                    ->send();
                            })
                    ),
                Select::make('wednesday_dish_id')
                    ->label('Onsdag ret')
                    ->options($options)
                    ->suffixAction(
                        Action::make('add_monday_dish_to_buy_list')
                            ->label('')
                            ->icon('heroicon-o-plus-circle')
                            ->action(function ($state) {
                                $dish = \App\Models\Dish::find($state);
                                if (!$dish) {
                                    return;
                                }
                                $this->household->add_dish_to_buy_list($dish);
                                Notification::make('dish_added')
                                    ->title('Ret tilføjet')
                                    ->duration(1500)
                                    ->success()
                                    ->send();
                            })
                    ),
                Select::make('thursday_dish_id')
                    ->label('Torsdag ret')
                    ->options($options)
                    ->suffixAction(
                        Action::make('add_monday_dish_to_buy_list')
                            ->label('')
                            ->icon('heroicon-o-plus-circle')
                            ->action(function ($state) {
                                $dish = \App\Models\Dish::find($state);
                                if (!$dish) {
                                    return;
                                }
                                $this->household->add_dish_to_buy_list($dish);
                                Notification::make('dish_added')
                                    ->title('Ret tilføjet')
                                    ->duration(1500)
                                    ->success()
                                    ->send();
                            })
                    ),
                Select::make('friday_dish_id')
                    ->label('Fredag ret')
                    ->options($options)
                    ->suffixAction(
                        Action::make('add_monday_dish_to_buy_list')
                            ->label('')
                            ->icon('heroicon-o-plus-circle')
                            ->action(function ($state) {
                                $dish = \App\Models\Dish::find($state);
                                if (!$dish) {
                                    return;
                                }
                                $this->household->add_dish_to_buy_list($dish);
                                Notification::make('dish_added')
                                    ->title('Ret tilføjet')
                                    ->duration(1500)
                                    ->success()
                                    ->send();
                            })
                    ),
                Select::make('saturday_dish_id')
                    ->label('Lørdag ret')
                    ->options($options)
                    ->suffixAction(
                        Action::make('add_monday_dish_to_buy_list')
                            ->label('')
                            ->icon('heroicon-o-plus-circle')
                            ->action(function ($state) {
                                $dish = \App\Models\Dish::find($state);
                                if (!$dish) {
                                    return;
                                }
                                $this->household->add_dish_to_buy_list($dish);
                                Notification::make('dish_added')
                                    ->title('Ret tilføjet')
                                    ->duration(1500)
                                    ->success()
                                    ->send();
                            })
                    ),
                Select::make('sunday_dish_id')
                    ->label('Søndag ret')
                    ->options($options)
                    ->suffixAction(
                        Action::make('add_monday_dish_to_buy_list')
                            ->label('')
                            ->icon('heroicon-o-plus-circle')
                            ->action(function ($state) {
                                $dish = \App\Models\Dish::find($state);
                                if (!$dish) {
                                    return;
                                }
                                $this->household->add_dish_to_buy_list($dish);
                                Notification::make('dish_added')
                                    ->title('Ret tilføjet')
                                    ->duration(1500)
                                    ->success()
                                    ->send();
                            })
                    ),
                TextInput::make('total_price')
                    ->label('Total Price')
                    ->suffix('Kr.')
                    ->disabled(),
            ])->columns(2)->statePath('data');
    }
    public function render()
    {
        return view('livewire.edit.week-plan');
    }

    public function update()
    {
        $this->validate();
        $this->week_plan->update($this->data);
        return redirect()->route('edit.week-plan', ['week_plan_id' => $this->week_plan->id]);
    }
}
