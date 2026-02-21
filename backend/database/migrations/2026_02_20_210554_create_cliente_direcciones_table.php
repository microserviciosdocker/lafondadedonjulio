<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente_direcciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->foreignId('empresa_id')->nullable()->constrained()->nullOnDelete();
            $table->string('alias')->default('Casa');
            $table->string('direccion');
            $table->string('referencia')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('contacto_nombre')->nullable();
            $table->string('contacto_phone')->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['cliente_id', 'is_default']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente_direcciones');
    }
};
