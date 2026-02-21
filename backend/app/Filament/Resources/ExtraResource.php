<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExtraResource\Pages;
use App\Models\CategoriaExtra;
use App\Models\Extra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExtraResource extends Resource
{
    protected static ?string $model = Extra::class;

    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';

    protected static ?string $navigationGroup = 'Menú';

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Extra';

    protected static ?string $pluralModelLabel = 'Extras / Adicionales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información General')
                    ->schema([
                        Forms\Components\Select::make('categoria_extra_id')
                            ->label('Categoría de Extra')
                            ->options(CategoriaExtra::pluck('nombre', 'id'))
                            ->searchable()
                            ->helperText('Agrupa extras similares (ej: Tortillas, Quesos)'),

                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\Textarea::make('descripcion')
                            ->rows(2)
                            ->maxLength(300),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Precio e Imagen')
                    ->schema([
                        Forms\Components\TextInput::make('precio')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->maxValue(99.99)
                            ->default(0),

                        Forms\Components\FileUpload::make('imagen')
                            ->image()
                            ->directory('extras')
                            ->imageEditor(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Configuración')
                    ->schema([
                        Forms\Components\Toggle::make('activo')
                            ->default(true)
                            ->required(),

                        Forms\Components\Toggle::make('requerido')
                            ->default(false)
                            ->helperText('El cliente debe seleccionar este extra'),

                        Forms\Components\TextInput::make('limite_min')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->label('Mínimo'),

                        Forms\Components\TextInput::make('limite_max')
                            ->numeric()
                            ->default(10)
                            ->minValue(1)
                            ->label('Máximo'),

                        Forms\Components\TextInput::make('orden')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('orden')
            ->defaultSort('orden')
            ->columns([
                Tables\Columns\TextColumn::make('orden')
                    ->label('#')
                    ->width(40)
                    ->sortable(),

                Tables\Columns\ImageColumn::make('imagen')
                    ->circular()
                    ->size(40),

                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('categoriaExtra.nombre')
                    ->label('Categoría')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('precio')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\IconColumn::make('activo')
                    ->boolean()
                    ->label('Activo'),

                Tables\Columns\IconColumn::make('requerido')
                    ->boolean()
                    ->label('Requerido'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categoria_extra_id')
                    ->label('Categoría')
                    ->options(CategoriaExtra::pluck('nombre', 'id')),

                Tables\Filters\TernaryFilter::make('activo')
                    ->label('Solo activos'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListExtras::route('/'),
            'create' => Pages\CreateExtra::route('/create'),
            'view' => Pages\ViewExtra::route('/{record}'),
            'edit' => Pages\EditExtra::route('/{record}/edit'),
        ];
    }
}
