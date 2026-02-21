<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PedidoItem extends Model
{
    protected $fillable = [
        'pedido_id',
        'producto_id',
        'producto_nombre',
        'precio_unitario',
        'cantidad',
        'subtotal_extras',
        'subtotal',
        'notas',
    ];

    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'subtotal_extras' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'cantidad' => 'integer',
    ];

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function extras(): HasMany
    {
        return $this->hasMany(PedidoItemExtra::class, 'pedido_item_id');
    }

    public function calcularSubtotal(): void
    {
        $this->subtotal_extras = $this->extras->sum('subtotal');
        $this->subtotal = ($this->precio_unitario * $this->cantidad) + $this->subtotal_extras;
    }
}
