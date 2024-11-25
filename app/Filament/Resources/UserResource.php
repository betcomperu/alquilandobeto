<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;

use Livewire\Component;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    public static function form(Form $form): Form
    {


        return $form
            ->schema([

                //Creame el formulario para el usuario
                TextInput::make('name')
                ->required()
                ->label('Nombre y Apellidos')
                ->maxLength(255),


                TextInput::make('email')
                ->required()
                ->label('Correo Electrónico'),


                TextInput::make('password')
                ->helperText('Ingrese una contraseña de 6 a 10 caracteres')
                ->password()
                ->required()
                ->visibleOn('create'),

                FileUpload::make('foto')
                ->helperText('Ingrese una imagen jpg o png de preferencia no mayor a 2MB')
                ->label('Foto')
                ->image()
                ->disk('public') // Asegúrate de que esto apunta al disco correcto
                ->directory('fotos')
                ->required(),


                Forms\Components\TextInput::make('usuario')
                ->label('Usuario o Nickname')
                ->nullable()
                ->sortable(),

                Forms\Components\Toggle::make('condicion')
                ->label('Activo')
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
                ->searchable()
                ->label('Nombre'),
                TextColumn::make('email')
                ->sortable()
                ->searchable()
                ->label('Correo Electrónico'),
                TextColumn::make('usuario')->label('Usuario')
                ->label('Usuario')
                ->sortable(),
                ImageColumn::make('foto')
                ->label('Foto')


                ->width(80)
                ->height(80)
                ->circular(),

                TextColumn::make('usuario')
                ->searchable(),
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
    protected function getStats(): array
{
    return [
        Stat::make('Unique views', '192.1k')
            ->description('32k increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),
        Stat::make('Bounce rate', '21%')
            ->description('7% decrease')
            ->descriptionIcon('heroicon-m-arrow-trending-down'),
        Stat::make('Average time on page', '3:12')
            ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),
    ];
}


}
