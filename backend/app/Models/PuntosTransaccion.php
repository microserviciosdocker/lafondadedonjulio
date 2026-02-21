<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PuntosTransaccion extends Model
{
    protected $fillable = [
        'cliente_id',
        'pedido_id',
        'tipo',
        'puntos',
        'saldo_anterior',
        'saldo_nuevo',
        'descripcion',
    ];

    protected $casts = [
        'puntos' => 'integer',
        'saldo_anterior' => 'integer',
        'saldo_nuevo' => 'integer',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public static function registrarGanado(Cliente $cliente, Pedido $pedido, int $puntos): self
    {
        $saldoAnterior = $cliente->puntos;
        $saldoNuevo = $saldoAnterior + $puntos;

        $transaccion = static::create([
            'cliente_id' => $cliente->id,
            'pedido_id' => $pedido->id,
            'tipo' => 'ganado',
            'puntos' => $puntos,
            'saldo_anterior' => $saldoAnterior,
            'saldo_nuevo' => $saldoNuevo,
            'descripcion' => "Puntos ganados por pedido #{$pedido->codigo}",
        ]);

        $cliente->update(['puntos' => $saldoNuevo]);

        return $transaccion;
    }

    public static function registrarUso(Cliente $cliente, Pedido $pedido, int $puntos): self
    {
        $saldoAnterior = $cliente->puntos;
        $saldoNuevo = $saldoAnterior - $puntos;

        $transaccion = static::create([
            'cliente_id' => $cliente->id,
            'pedido_id' => $pedido->id,
            'tipo' => 'usado',
            'puntos' => $puntos,
            'saldo_anterior' => $saldoAnterior,
            'saldo_nuevo' => $saldoNuevo,
            'descripcion' => "Puntos usados en pedido #{$pedido->codigo}",
        ]);

        $cliente->update(['puntos' => $saldoNuevo]);

        return $transaccion;
    }
}
