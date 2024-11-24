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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Forms\Components\TextInput;



class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Creame el formulario para el usuario
                TextInput::make('name')
                ->required()
                ->label('Nombre')
                ->maxLength(255),

                TextInput::make('email')
                ->required()
                ->label('Correo Electrónico'),
                TextInput::make('password')
                ->password()
                ->required()
                ->visibleOn('create'),

                FileUpload::make('foto')
                ->label('Foto')
                ->image()
                ->disk('public') // Asegúrate de que esto apunta al disco correcto
                ->directory('fotos')
                ->required(),


                Forms\Components\TextInput::make('usuario')
                ->label('Usuario')
                ->nullable(),

                Forms\Components\Toggle::make('condicion')
                ->label('Condición')
                ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')
                ->sortable()
                ->label('ID'),
                TextColumn::make('name')
                ->sortable()
                ->label('Nombre'),
                TextColumn::make('email')
                ->sortable()
                ->label('Correo Electrónico'),
                TextColumn::make('usuario')->label('Usuario')
                ->label('Usuario')
                ->sortable(),
                ImageColumn::make('foto')
                ->label('Foto')


                ->width(80)
                ->height(80)
                ->circular(),

                TextColumn::make('usuario'),
                IconColumn::make('condicion')
                ->boolean(),
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
