<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repartidor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nombre',
        'email',
        'phone',
        'foto',
        'licencia',
        'vehiculo_tipo',
        'vehiculo_placa',
        'vehiculo_color',
        'latitud',
        'longitud',
        'ubicacion_updated_at',
        'disponible',
        'activo',
        'calificacion',
        'total_entregas',
    ];

    protected $casts = [
        'ubicacion_updated_at' => 'datetime',
        'disponible' => 'boolean',
        'activo' => 'boolean',
        'calificacion' => 'decimal:2',
        'total_entregas' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }

    public function pedidosActivos(): HasMany
    {
        return $this->pedidos()->whereIn('estado', ['en_ruta']);
    }

    public function pedidosPendientes(): HasMany
    {
        return $this->pedidos()->whereIn('estado', ['listo', 'confirmado', 'preparando']);
    }

    public function isDisponible(): bool
    {
        return $this->activo && $this->disponible;
    }

    public function updateUbicacion(string $lat, string $lng): void
    {
        $this->update([
            'latitud' => $lat,
            'longitud' => $lng,
            'ubicacion_updated_at' => now(),
        ]);
    }
}
