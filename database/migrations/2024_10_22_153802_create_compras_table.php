<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_pago', ['tarjeta_credito', 'paypal', 'bitcoin', 'credito_tienda'])
                ->default('tarjeta_credito');
            $table->enum('estado_pago', ['completado', 'pendiente'])
                ->default('pendiente');
            $table->decimal('precio_total');
            $table->timestamps();
            
            $table->unsignedBigInteger('usuario_fk');
            $table->foreign('usuario_fk')->references('id')->on('usuarios');#->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
