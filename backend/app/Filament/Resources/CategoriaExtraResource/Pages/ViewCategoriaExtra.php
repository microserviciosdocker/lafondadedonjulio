<?php

namespace App\Filament\Resources\CategoriaExtraResource\Pages;

use App\Filament\Resources\CategoriaExtraResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCategoriaExtra extends ViewRecord
{
    protected static string $resource = CategoriaExtraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
