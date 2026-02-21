<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntosConfig extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'tipo',
        'puntos',
        'monto_minimo',
        'monto_equivalente',
        'activo',
    ];

    protected $casts = [
        'monto_minimo' => 'decimal:2',
        'monto_equivalente' => 'decimal:2',
        'puntos' => 'integer',
        'activo' => 'boolean',
    ];

    public static function getConfigActiva(string $slug): ?self
    {
        return static::where('slug', $slug)->where('activo', true)->first();
    }

    public static function calcularPuntos(float $monto): int
    {
        $config = static::getConfigActiva('puntos_por_monto');
        if (!$config) {
            return 0;
        }

        return (int) floor($monto * $config->puntos);
    }
}
