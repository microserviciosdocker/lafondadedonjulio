<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nombre');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('verification_code', 6)->nullable();
            $table->timestamp('verification_code_expires_at')->nullable();
            $table->string('preferred_contact_method')->default('whatsapp');
            $table->boolean('is_trusted')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('puntos')->default(0);
            $table->integer('total_pedidos')->default(0);
            $table->decimal('total_gastado', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['phone', 'is_active']);
            $table->index(['user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
