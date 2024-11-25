<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InmuebleResource\Pages;
use App\Filament\Resources\InmuebleResource\RelationManagers;
use App\Models\Inmueble;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Support\Enums\Alignment;



class InmuebleResource extends Resource
{
    protected static ?string $model = Inmueble::class;

    protected static ?string $navigationIcon = 'heroicon-s-building-office';

    public static function form(Form $form): Form
    {
        $provincias = [
            'Amazonas' => 'Amazonas',
            'Áncash' => 'Áncash',
            'Apurímac' => 'Apurímac',
            'Arequipa' => 'Arequipa',
            'Ayacucho' => 'Ayacucho',
            'Cajamarca' => 'Cajamarca',
            'Callao' => 'Callao',
            'Cusco' => 'Cusco',
            'Huancavelica' => 'Huancavelica',
            'Huánuco' => 'Huánuco',
            'Ica' => 'Ica',
            'Junín' => 'Junín',
            'La Libertad' => 'La Libertad',
            'Lambayeque' => 'Lambayeque',
            'Lima' => 'Lima',
            'Loreto' => 'Loreto',
            'Madre de Dios' => 'Madre de Dios',
            'Moquegua' => 'Moquegua',
            'Pasco' => 'Pasco',
            'Piura' => 'Piura',
            'Puno' => 'Puno',
            'San Martín' => 'San Martín',
            'Tacna' => 'Tacna',
            'Tumbes' => 'Tumbes',
            'Ucayali' => 'Ucayali',
        ];
        $distritos = [
            'Cercado de Lima' => 'Cercado de Lima',
            'Ate' => 'Ate',
            'Barranco' => 'Barranco',
            'Breña' => 'Breña',
            'Comas' => 'Comas',
            'Chaclacayo' => 'Chaclacayo',
            'Chorrillos' => 'Chorrillos',
            'El Agustino' => 'El Agustino',
            'Jesús María' => 'Jesús María',
            'La Molina' => 'La Molina',
            'La Victoria' => 'La Victoria',
            'Lince' => 'Lince',
            'Los Olivos' => 'Los Olivos',
            'Lurigancho' => 'Lurigancho',
            'Lurín' => 'Lurín',
            'Magdalena del Mar' => 'Magdalena del Mar',
            'Miraflores' => 'Miraflores',
            'Pachacámac' => 'Pachacámac',
            'Pucusana' => 'Pucusana',
            'Pueblo Libre' => 'Pueblo Libre',
            'Puente Piedra' => 'Puente Piedra',
            'Punta Hermosa' => 'Punta Hermosa',
            'Punta Negra' => 'Punta Negra',
            'Rímac' => 'Rímac',
            'San Bartolo' => 'San Bartolo',
            'San Borja' => 'San Borja',
            'San Isidro' => 'San Isidro',
            'San Juan de Lurigancho' => 'San Juan de Lurigancho',
            'San Juan de Miraflores' => 'San Juan de Miraflores',
            'San Luis' => 'San Luis',
            'San Martín de Porres' => 'San Martín de Porres',
            'San Miguel' => 'San Miguel',
            'Santa Anita' => 'Santa Anita',
            'Santa María del Mar' => 'Santa María del Mar',
            'Santa Rosa' => 'Santa Rosa',
            'Santiago de Surco' => 'Santiago de Surco',
            'Surquillo' => 'Surquillo',
            'Villa El Salvador' => 'Villa El Salvador',
            'Villa María del Triunfo' => 'Villa María del Triunfo',
        ];


        return $form
            ->schema([
                //
                TextInput::make('direccion')
                ->required()
                ->label('Dirección del inmueble')
                ->maxLength(255),

                Select::make('provincia')
                ->options($provincias)
                ->required()
                ->label('Provincia'),

                Textarea::make('detalles')
                ->label('Detalles')
                ->nullable(),

                Select::make('distrito')
                ->options($distritos)
                ->required()
                ->label('Distrito'),

                FileUpload::make('foto')
                ->label('Imagen del Inmueble')
                ->helperText('Ingrese una imagen jpg o png de preferencia no mayor a 2MB')
                ->image()
                ->disk('public')
                ->directory('inmuebles')
                ->required(),

                TextInput::make('precio')
                ->required()
                ->label('Precio de Alquiler')
                ->helperText('Ingrese el monto del alquiler será en soles S/')
                ->numeric(),

                TextInput::make('alias')
                ->label('Alias del Inmueble')
                ->nullable(),

                Select::make('iduser')
                ->label('Usuario')
                ->options(
                    User::all()->pluck('name', 'id')
                )
                ->required(),
                Toggle::make('estado')
                ->label('Disponible')
                ->default(true)



            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Split::make([
                    Stack::make([
                            TextColumn::make('direccion'),
                         //   ->icon('heroicon-m-map-pin'),
                            TextColumn::make('provincia'),
                            TextColumn::make('distrito'),
                    ])->alignment(Alignment::End),
                    ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->visibility('public')
                    ->width(80)
                    ->height(80)
                    ->square(),
                    TextColumn::make('detalles')
                                            ->weight(FontWeight::Bold)
                                            ->searchable()
                                            ->sortable(),
                                            TextColumn::make('precio')
                ->sortable()
                ->label('Precio')
                ->money('PEN'),


            TextColumn::make('alias')
                ->sortable()
                ->label('Alias'),

            BooleanColumn::make('estado')
                ->label('Estado'),

            TextColumn::make('user.name')
                ->label('Nombre del Usuario')
                ->sortable(),
                ])


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
