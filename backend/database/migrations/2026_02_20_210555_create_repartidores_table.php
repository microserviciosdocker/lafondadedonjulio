<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repartidores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nombre');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('foto')->nullable();
            $table->string('licencia')->nullable();
            $table->string('vehiculo_tipo')->default('moto');
            $table->string('vehiculo_placa')->nullable();
            $table->string('vehiculo_color')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->timestamp('ubicacion_updated_at')->nullable();
            $table->boolean('disponible')->default(false);
            $table->boolean('activo')->default(true);
            $table->decimal('calificacion', 3, 2)->default(5.00);
            $table->integer('total_entregas')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['activo', 'disponible']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repartidores');
    }
};
