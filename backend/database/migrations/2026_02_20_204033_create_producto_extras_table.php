<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto_extras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained()->onDelete('cascade');
            $table->foreignId('extra_id')->constrained()->onDelete('cascade');
            $table->decimal('precio_especial', 10, 2)->nullable();
            $table->boolean('requerido')->default(false);
            $table->integer('limite_min')->default(0);
            $table->integer('limite_max')->default(10);
            $table->integer('orden')->default(0);
            $table->timestamps();

            $table->unique(['producto_id', 'extra_id']);
            $table->index(['producto_id', 'orden']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto_extras');
    }
};
