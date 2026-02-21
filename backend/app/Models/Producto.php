<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'slug',
        'descripcion',
        'incluye',
        'precio',
        'precio_promocion',
        'imagen',
        'orden',
        'activo',
        'disponible',
        'destacado',
        'es_menu_del_dia',
        'permite_extras',
        'disponible_desde',
        'disponible_hasta',
        'tiempo_preparacion',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'precio_promocion' => 'decimal:2',
        'activo' => 'boolean',
        'disponible' => 'boolean',
        'destacado' => 'boolean',
        'es_menu_del_dia' => 'boolean',
        'permite_extras' => 'boolean',
        'disponible_desde' => 'datetime:H:i',
        'disponible_hasta' => 'datetime:H:i',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function extras(): BelongsToMany
    {
        return $this->belongsToMany(Extra::class, 'producto_extras')
            ->withPivot(['precio_especial', 'requerido', 'limite_min', 'limite_max', 'orden'])
            ->withTimestamps()
            ->orderByPivot('orden');
    }

    public function getPrecioActualAttribute(): float
    {
        return $this->precio_promocion ?? $this->precio;
    }

    public function estaDisponible(): bool
    {
        if (! $this->activo || ! $this->disponible) {
            return false;
        }

        if ($this->disponible_desde && $this->disponible_hasta) {
            $ahora = now()->format('H:i');
            if ($ahora < $this->disponible_desde || $ahora > $this->disponible_hasta) {
                return false;
            }
        }

        return true;
    }
}
