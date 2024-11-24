<?php

namespace App\Filament\Resources;

use Livewire\Component;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Creame el formulario para el usuario
                Forms\Components\TextInput::make('name')
                ->required()
                ->label('Nombre')
                ->maxLength(255),

                Forms\Components\TextInput::make('email')
                ->required()
                ->label('Correo Electrónico'),
                Forms\Components\TextInput::make('password')
                ->password()
                ->required()
                ->visibleOn('create'),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id')
                ->sortable()
                ->label('ID'),
                Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->label('Nombre'),
                Tables\Columns\TextColumn::make('email')
                ->sortable()
                ->label('Correo Electrónico'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
