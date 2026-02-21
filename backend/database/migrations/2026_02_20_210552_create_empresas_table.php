<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->string('direccion');
            $table->string('referencia')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('contacto_nombre')->nullable();
            $table->string('contacto_phone')->nullable();
            $table->string('contacto_email')->nullable();
            $table->time('horario_entrega_desde')->default('12:30:00');
            $table->time('horario_entrega_hasta')->default('13:30:00');
            $table->decimal('tarifa_envio_individual', 10, 2)->default(0);
            $table->boolean('envio_grupal_gratis')->default(true);
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['activo', 'nombre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
