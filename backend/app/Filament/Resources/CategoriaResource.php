<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationGroup = 'Menú';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Categoría';

    protected static ?string $pluralModelLabel = 'Categorías';

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
                            ->rows(3)
                            ->maxLength(500),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Imagen y Icono')
                    ->schema([
                        Forms\Components\FileUpload::make('imagen')
                            ->image()
                            ->directory('categorias')
                            ->imageEditor()
                            ->columnSpanFull(),

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

                        Forms\Components\Toggle::make('destacado')
                            ->default(false),

                        Forms\Components\TextInput::make('orden')
                            ->numeric()
                            ->default(0)
                            ->helperText('Orden de visualización (se puede arrastrar en la lista)'),
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

                Tables\Columns\TextColumn::make('productos_count')
                    ->label('Productos')
                    ->counts('productos')
                    ->badge(),

                Tables\Columns\IconColumn::make('activo')
                    ->boolean()
                    ->label('Activo'),

                Tables\Columns\IconColumn::make('destacado')
                    ->boolean()
                    ->label('Destacado'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('activo')
                    ->label('Solo activos'),
                Tables\Filters\TernaryFilter::make('destacado')
                    ->label('Destacados'),
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
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'view' => Pages\ViewCategoria::route('/{record}'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }
}
