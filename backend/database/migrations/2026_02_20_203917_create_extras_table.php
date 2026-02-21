<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('extras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_extra_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2)->default(0);
            $table->string('imagen')->nullable();
            $table->integer('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->boolean('requerido')->default(false);
            $table->integer('limite_min')->default(0);
            $table->integer('limite_max')->default(10);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['categoria_extra_id', 'orden', 'activo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('extras');
    }
};
