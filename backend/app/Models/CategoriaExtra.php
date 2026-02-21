<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaExtra extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'icono',
        'orden',
        'activo',
        'multiple',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'multiple' => 'boolean',
    ];

    public function extras(): HasMany
    {
        return $this->hasMany(Extra::class)->orderBy('orden');
    }

    public function extrasActivos(): HasMany
    {
        return $this->hasMany(Extra::class)
            ->where('activo', true)
            ->orderBy('orden');
    }
}
