<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'slug',
        'direccion',
        'referencia',
        'latitud',
        'longitud',
        'contacto_nombre',
        'contacto_phone',
        'contacto_email',
        'horario_entrega_desde',
        'horario_entrega_hasta',
        'tarifa_envio_individual',
        'envio_grupal_gratis',
        'activo',
    ];

    protected $casts = [
        'horario_entrega_desde' => 'datetime:H:i',
        'horario_entrega_hasta' => 'datetime:H:i',
        'tarifa_envio_individual' => 'decimal:2',
        'envio_grupal_gratis' => 'boolean',
        'activo' => 'boolean',
    ];

    public function direcciones(): HasMany
    {
        return $this->hasMany(ClienteDireccion::class);
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }

    public function getHorarioEntregaAttribute(): string
    {
        return $this->horario_entrega_desde . ' - ' . $this->horario_entrega_hasta;
    }
}
