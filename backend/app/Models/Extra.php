<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extra extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'categoria_extra_id',
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'orden',
        'activo',
        'requerido',
        'limite_min',
        'limite_max',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
        'requerido' => 'boolean',
    ];

    public function categoriaExtra(): BelongsTo
    {
        return $this->belongsTo(CategoriaExtra::class);
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'producto_extras')
            ->withPivot(['precio_especial', 'requerido', 'limite_min', 'limite_max', 'orden'])
            ->withTimestamps();
    }
}
