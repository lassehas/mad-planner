<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeekPlanResource\Pages;
use App\Filament\Resources\WeekPlanResource\RelationManagers;
use App\Models\WeekPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeekPlanResource extends Resource
{
    protected static ?string $model = WeekPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('house_hold_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('monday_dish_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('tuesday_dish_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('wednesday_dish_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('thursday_dish_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('friday_dish_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('saturday_dish_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('sunday_dish_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('house_hold_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('monday_dish_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tuesday_dish_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wednesday_dish_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('thursday_dish_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('friday_dish_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('saturday_dish_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sunday_dish_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWeekPlans::route('/'),
            'create' => Pages\CreateWeekPlan::route('/create'),
            'edit' => Pages\EditWeekPlan::route('/{record}/edit'),
        ];
    }
}
