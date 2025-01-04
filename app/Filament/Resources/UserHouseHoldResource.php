<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserHouseHoldResource\Pages;
use App\Filament\Resources\UserHouseHoldResource\RelationManagers;
use App\Models\UserHouseHold;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserHouseHoldResource extends Resource
{
    protected static ?string $model = UserHouseHold::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User Id')
                    ->required()
                    ->searchable()
                    ->options(fn () => \App\Models\User::all()->pluck('name', 'id')->toArray()),
                Forms\Components\Select::make('house_hold_id')
                    ->label('House Hold Id')
                    ->required()
                    ->searchable()
                    ->options(fn () => \App\Models\HouseHold::all()->pluck('name', 'id')->toArray()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('house_hold_id'),
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
            'index' => Pages\ListUserHouseHolds::route('/'),
            'create' => Pages\CreateUserHouseHold::route('/create'),
            'edit' => Pages\EditUserHouseHold::route('/{record}/edit'),
        ];
    }
}
