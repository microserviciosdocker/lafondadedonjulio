<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaExtraResource\Pages;
use App\Models\CategoriaExtra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoriaExtraResource extends Resource
{
    protected static ?string $model = CategoriaExtra::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Menú';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Categoría de Extra';

    protected static ?string $pluralModelLabel = 'Categorías de Extras';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información General')
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('descripcion')
                            ->rows(2)
                            ->maxLength(300),

                        Forms\Components\TextInput::make('icono')
                            ->maxLength(50)
                            ->helperText('Icono de Heroicons (ej: heroicon-o-cake)'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Configuración')
                    ->schema([
                        Forms\Components\Toggle::make('activo')
                            ->default(true)
                            ->required(),

                        Forms\Components\Toggle::make('multiple')
                            ->default(true)
                            ->helperText('¿Permite seleccionar múltiples extras?'),

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

                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('extras_count')
                    ->label('Extras')
                    ->counts('extras')
                    ->badge(),

                Tables\Columns\IconColumn::make('activo')
                    ->boolean()
                    ->label('Activa'),

                Tables\Columns\IconColumn::make('multiple')
                    ->boolean()
                    ->label('Múltiple'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('activo')
                    ->label('Solo activas'),
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
            'index' => Pages\ListCategoriaExtras::route('/'),
            'create' => Pages\CreateCategoriaExtra::route('/create'),
            'view' => Pages\ViewCategoriaExtra::route('/{record}'),
            'edit' => Pages\EditCategoriaExtra::route('/{record}/edit'),
        ];
    }
}
