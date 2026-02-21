<?php

namespace App\Filament\Resources\CategoriaExtraResource\Pages;

use App\Filament\Resources\CategoriaExtraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoriaExtras extends ListRecords
{
    protected static string $resource = CategoriaExtraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
