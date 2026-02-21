<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nombre',
        'email',
        'phone',
        'phone_verified_at',
        'verification_code',
        'verification_code_expires_at',
        'preferred_contact_method',
        'is_trusted',
        'is_active',
        'puntos',
        'total_pedidos',
        'total_gastado',
    ];

    protected $casts = [
        'phone_verified_at' => 'datetime',
        'verification_code_expires_at' => 'datetime',
        'is_trusted' => 'boolean',
        'is_active' => 'boolean',
        'puntos' => 'integer',
        'total_pedidos' => 'integer',
        'total_gastado' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function direcciones(): HasMany
    {
        return $this->hasMany(ClienteDireccion::class);
    }

    public function direccionDefault()
    {
        return $this->direcciones()->where('is_default', true)->first();
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }

    public function puntosTransacciones(): HasMany
    {
        return $this->hasMany(PuntosTransaccion::class);
    }

    public function isVerified(): bool
    {
        return !is_null($this->phone_verified_at);
    }

    public function canPayOnDelivery(): bool
    {
        return $this->is_trusted && $this->total_pedidos >= 3;
    }
}
