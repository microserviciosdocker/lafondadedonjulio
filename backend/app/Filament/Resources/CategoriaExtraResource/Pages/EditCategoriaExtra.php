<?php

namespace App\Filament\Resources\CategoriaExtraResource\Pages;

use App\Filament\Resources\CategoriaExtraResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoriaExtra extends EditRecord
{
    protected static string $resource = CategoriaExtraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
