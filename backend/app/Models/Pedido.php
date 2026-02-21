<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo',
        'cliente_id',
        'repartidor_id',
        'empresa_id',
        'cliente_direccion_id',
        'tipo_envio',
        'subtotal',
        'costo_envio',
        'descuento',
        'puntos_usados',
        'total',
        'estado',
        'metodo_pago',
        'estado_pago',
        'comprobante_pago',
        'monto_efectivo',
        'cambio',
        'notas_cliente',
        'notas_internas',
        'latitud_entrega',
        'longitud_entrega',
        'hora_entrega_programada',
        'confirmado_at',
        'listo_at',
        'en_ruta_at',
        'entregado_at',
        'cancelado_at',
        'puntos_ganados',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'costo_envio' => 'decimal:2',
        'descuento' => 'decimal:2',
        'puntos_usados' => 'decimal:2',
        'total' => 'decimal:2',
        'monto_efectivo' => 'decimal:2',
        'cambio' => 'decimal:2',
        'hora_entrega_programada' => 'datetime:H:i',
        'confirmado_at' => 'datetime',
        'listo_at' => 'datetime',
        'en_ruta_at' => 'datetime',
        'entregado_at' => 'datetime',
        'cancelado_at' => 'datetime',
        'puntos_ganados' => 'integer',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function repartidor(): BelongsTo
    {
        return $this->belongsTo(Repartidor::class);
    }

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function direccion(): BelongsTo
    {
        return $this->belongsTo(ClienteDireccion::class, 'cliente_direccion_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function puntosTransaccion()
    {
        return $this->hasOne(PuntosTransaccion::class);
    }

    public static function generarCodigo(): string
    {
        return 'FDJ-' . strtoupper(substr(uniqid(), -6));
    }

    public function calcularTotal(): void
    {
        $this->subtotal = $this->items->sum('subtotal');
        $this->total = $this->subtotal + $this->costo_envio - $this->descuento - $this->puntos_usados;
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->estado, ['pendiente', 'confirmado']);
    }

    public function canPayOnDelivery(): bool
    {
        return $this->cliente->canPayOnDelivery() && $this->metodo_pago === 'efectivo';
    }
}
