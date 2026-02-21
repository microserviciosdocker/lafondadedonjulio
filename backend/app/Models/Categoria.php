<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'icono',
        'imagen',
        'orden',
        'activo',
        'destacado',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'destacado' => 'boolean',
    ];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class)->orderBy('orden');
    }

    public function productosActivos(): HasMany
    {
        return $this->hasMany(Producto::class)
            ->where('activo', true)
            ->where('disponible', true)
            ->orderBy('orden');
    }
}
