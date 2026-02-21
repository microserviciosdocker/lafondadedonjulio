<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('descripcion')->nullable();
            $table->text('incluye')->nullable();
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_promocion', 10, 2)->nullable();
            $table->string('imagen')->nullable();
            $table->integer('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->boolean('disponible')->default(true);
            $table->boolean('destacado')->default(false);
            $table->boolean('es_menu_del_dia')->default(false);
            $table->boolean('permite_extras')->default(true);
            $table->time('disponible_desde')->nullable();
            $table->time('disponible_hasta')->nullable();
            $table->integer('tiempo_preparacion')->default(15);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['categoria_id', 'orden', 'activo']);
            $table->index(['es_menu_del_dia', 'activo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
