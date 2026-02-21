<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->foreignId('repartidor_id')->nullable()->constrained('repartidores')->nullOnDelete();
            $table->foreignId('empresa_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('cliente_direccion_id')->nullable()->constrained('cliente_direcciones')->nullOnDelete();

            $table->enum('tipo_envio', ['individual', 'grupal'])->default('individual');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('costo_envio', 10, 2)->default(0);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('puntos_usados', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);

            $table->enum('estado', [
                'pendiente',
                'confirmado',
                'preparando',
                'listo',
                'en_ruta',
                'entregado',
                'cancelado'
            ])->default('pendiente');

            $table->enum('metodo_pago', ['transferencia', 'efectivo'])->default('transferencia');
            $table->enum('estado_pago', ['pendiente', 'verificado', 'completado'])->default('pendiente');
            $table->string('comprobante_pago')->nullable();

            $table->decimal('monto_efectivo', 10, 2)->nullable();
            $table->decimal('cambio', 10, 2)->nullable();
            $table->text('notas_cliente')->nullable();
            $table->text('notas_internas')->nullable();

            $table->string('latitud_entrega')->nullable();
            $table->string('longitud_entrega')->nullable();
            $table->time('hora_entrega_programada')->nullable();
            $table->timestamp('confirmado_at')->nullable();
            $table->timestamp('listo_at')->nullable();
            $table->timestamp('en_ruta_at')->nullable();
            $table->timestamp('entregado_at')->nullable();
            $table->timestamp('cancelado_at')->nullable();

            $table->integer('puntos_ganados')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['estado', 'created_at']);
            $table->index(['cliente_id', 'estado']);
            $table->index(['repartidor_id', 'estado']);
            $table->index(['empresa_id', 'hora_entrega_programada']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
