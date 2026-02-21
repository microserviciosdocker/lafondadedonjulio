<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedido_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained()->onDelete('cascade');
            $table->foreignId('producto_id')->constrained()->onDelete('cascade');
            $table->string('producto_nombre');
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('cantidad')->default(1);
            $table->decimal('subtotal_extras', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->index(['pedido_id']);
        });

        Schema::create('pedido_item_extras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('extra_id')->constrained()->onDelete('cascade');
            $table->string('extra_nombre');
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('cantidad')->default(1);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            $table->index(['pedido_item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido_item_extras');
        Schema::dropIfExists('pedido_items');
    }
};
