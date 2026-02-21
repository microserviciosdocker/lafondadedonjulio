<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('puntos_configs', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['por_pedido', 'por_monto', 'promocion'])->default('por_monto');
            $table->integer('puntos')->default(1);
            $table->decimal('monto_minimo', 10, 2)->nullable();
            $table->decimal('monto_equivalente', 10, 2)->default(0.01);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('puntos_transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->foreignId('pedido_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('tipo', ['ganado', 'usado', 'expirado', 'ajuste'])->default('ganado');
            $table->integer('puntos');
            $table->integer('saldo_anterior');
            $table->integer('saldo_nuevo');
            $table->string('descripcion');
            $table->timestamps();

            $table->index(['cliente_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puntos_transacciones');
        Schema::dropIfExists('puntos_configs');
    }
};
