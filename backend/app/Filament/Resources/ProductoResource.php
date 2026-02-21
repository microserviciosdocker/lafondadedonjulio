<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Models\Categoria;
use App\Models\Extra;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    protected static ?string $navigationGroup = 'Menú';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Producto';

    protected static ?string $pluralModelLabel = 'Productos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información General')
                    ->schema([
                        Forms\Components\Select::make('categoria_id')
                            ->label('Categoría')
                            ->options(Categoria::pluck('nombre', 'id'))
                            ->required()
                            ->searchable(),

                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(150)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('descripcion')
                            ->rows(2)
                            ->maxLength(500),

                        Forms\Components\Textarea::make('incluye')
                            ->rows(2)
                            ->maxLength(500)
                            ->helperText('Ej: Sopa, 1 porción de gallina, 2 tortillas, 1 fresco'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Precios')
                    ->schema([
                        Forms\Components\TextInput::make('precio')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->maxValue(999.99),

                        Forms\Components\TextInput::make('precio_promocion')
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->maxValue(999.99)
                            ->helperText('Dejar vacío si no hay promoción'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Imagen')
                    ->schema([
                        Forms\Components\FileUpload::make('imagen')
                            ->image()
                            ->directory('productos')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Disponibilidad')
                    ->schema([
                        Forms\Components\Toggle::make('activo')
                            ->default(true)
                            ->required(),

                        Forms\Components\Toggle::make('disponible')
                            ->default(true)
                            ->required(),

                        Forms\Components\Toggle::make('destacado')
                            ->default(false),

                        Forms\Components\Toggle::make('es_menu_del_dia')
                            ->default(false)
                            ->label('¿Es menú del día?'),

                        Forms\Components\Toggle::make('permite_extras')
                            ->default(true)
                            ->label('¿Permite extras?'),

                        Forms\Components\TextInput::make('tiempo_preparacion')
                            ->numeric()
                            ->suffix('minutos')
                            ->default(15)
                            ->minValue(1),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Extras Disponibles')
                    ->schema([
                        Forms\Components\Repeater::make('extras')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('extra_id')
                                    ->label('Extra')
                                    ->options(Extra::where('activo', true)->pluck('nombre', 'id'))
                                    ->required()
                                    ->searchable(),

                                Forms\Components\TextInput::make('precio_especial')
                                    ->numeric()
                                    ->prefix('$')
                                    ->helperText('Dejar vacío para usar precio default'),

                                Forms\Components\Toggle::make('requerido')
                                    ->default(false),

                                Forms\Components\TextInput::make('limite_min')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),

                                Forms\Components\TextInput::make('limite_max')
                                    ->numeric()
                                    ->default(10)
                                    ->minValue(1),

                                Forms\Components\TextInput::make('orden')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->columns(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): string => Extra::find($state['extra_id'] ?? null)?->nombre ?? 'Nuevo extra'),
                    ])
                    ->visible(fn (callable $get) => $get('permite_extras')),
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
                    ->weight('medium')
                    ->description(fn (Producto $record): string => $record->categoria->nombre ?? ''),

                Tables\Columns\TextColumn::make('precio_actual')
                    ->label('Precio')
                    ->money('USD')
                    ->sortable()
                    ->color(fn (Producto $record) => $record->precio_promocion ? 'success' : null),

                Tables\Columns\IconColumn::make('disponible')
                    ->boolean()
                    ->label('Disponible'),

                Tables\Columns\IconColumn::make('es_menu_del_dia')
                    ->boolean()
                    ->label('Menú del día'),

                Tables\Columns\IconColumn::make('activo')
                    ->boolean()
                    ->label('Activo'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categoria_id')
                    ->label('Categoría')
                    ->options(Categoria::pluck('nombre', 'id')),

                Tables\Filters\TernaryFilter::make('activo')
                    ->label('Solo activos'),

                Tables\Filters\TernaryFilter::make('es_menu_del_dia')
                    ->label('Menú del día'),

                Tables\Filters\TernaryFilter::make('disponible')
                    ->label('Disponibles'),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'view' => Pages\ViewProducto::route('/{record}'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
