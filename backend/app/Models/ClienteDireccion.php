<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClienteDireccion extends Model
{
    protected $fillable = [
        'cliente_id',
        'empresa_id',
        'alias',
        'direccion',
        'referencia',
        'latitud',
        'longitud',
        'contacto_nombre',
        'contacto_phone',
        'is_default',
        'is_active',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'cliente_direccion_id');
    }

    public function getDireccionCompletaAttribute(): string
    {
        $direccion = $this->direccion;
        if ($this->empresa) {
            $direccion .= ' - ' . $this->empresa->nombre;
        }
        if ($this->referencia) {
            $direccion .= ' (Ref: ' . $this->referencia . ')';
        }
        return $direccion;
    }
}
