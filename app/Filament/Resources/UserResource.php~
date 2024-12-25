<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-c-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->visible(fn ($record) => $record === null) // Mostrar solo en la creación
                    ->confirmed(),
                TextInput::make('password_confirmation')
                    ->label('Confirm Password')
                    ->password()
                    ->required()
                    ->visible(fn ($record) => $record === null),
                     // Mostrar solo en la creación
                FileUpload::make('foto')
                     ->label('Foto')
                     ->image()
                     ->directory('usuarios-foto')
                     ->nullable(),

                Select::make('roles')
                     ->relationship('roles', 'name')
                     ->multiple()
                     ->preload()
                     ->searchable()
                     ->label('Roles'),

                TextInput::make('usuario')
                    ->label('Username')
                    ->required(),
                Toggle::make('condicion')
                    ->label('Condition')
                    ->onIcon('heroicon-s-check')
                    ->offIcon('heroicon-s-x-circle')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('foto')->label('Foto')->Circular()->size(80),
            TextColumn::make('name')->label('Name')->sortable(),
            TextColumn::make('email')->label('Email')->sortable(),
            TextColumn::make('roles.name')
                 ->label('Roles')
                 ->getStateUsing(function ($record) { return $record->roles->pluck('name')->join(', '); }),

            TextColumn::make('usuario')->label('Username'),
            BooleanColumn::make('condicion')->label('Condition'),
            TextColumn::make('created_at')->label('Created At')->sortable()->date(),
            TextColumn::make('updated_at')->label('Updated At')->sortable()->date(),
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




