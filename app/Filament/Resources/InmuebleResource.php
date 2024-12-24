<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InmuebleResource\Pages;
use App\Filament\Resources\InmuebleResource\Pages\CreateInmueble;
use App\Filament\Resources\InmuebleResource\Pages\EditInmueble;
use App\Filament\Resources\InmuebleResource\Pages\ListInmuebles;
use App\Filament\Resources\InmuebleResource\RelationManagers;
use App\Models\Inmueble;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InmuebleResource extends Resource
{
    protected static ?string $model = Inmueble::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('direccion')->label('Dirección')->required(),
            TextInput::make('provincia')->label('Provincia')->required(),
            TextInput::make('distrito')->label('Distrito')->required(),
            Textarea::make('detalles')->label('Detalles')->nullable(),
            FileUpload::make('foto')
            ->label('Foto')
            ->directory('inmuebles-foto')
            ->disk('public')
            ->preserveFilenames()
            ->maxSize(4096),
            TextInput::make('precio')->label('Precio')->numeric()->required(),
            TextInput::make('alias')->label('Alias')->nullable(),
            Toggle::make('estado')
                    ->label('Estado')
                    ->onColor('success') // Verde para Alquilado
                    ->offColor('danger') // Rojo para Desocupado
                    ->onIcon('heroicon-s-check') // Icono para Alquilado
                    ->offIcon('heroicon-m-check-circle') // Icono para Desocupado
                    ->inline(false),
            Forms\Components\Select::make('iduser')->relationship('user', 'name')->label('Usuario')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('foto')->label('Foto')->size(80),
            TextColumn::make('direccion')->label('Dirección')->sortable(),
            TextColumn::make('provincia')->label('Provincia')->sortable(),
            TextColumn::make('distrito')->label('Distrito')->sortable(),
            TextColumn::make('precio')->label('Precio')->sortable(),
            TextColumn::make('user.name')->label('Usuario')->sortable(),

            ToggleColumn::make('estado')
                    ->label('Estado')
                    ->onIcon('heroicon-s-check')
                    ->offIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable(), // Habilita la clasificación para esta columna
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
            'index' => Pages\ListInmuebles::route('/'),
            'create' => Pages\CreateInmueble::route('/create'),
            'edit' => Pages\EditInmueble::route('/{record}/edit'),
        ];
    }
}
