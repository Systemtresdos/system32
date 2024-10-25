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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->timestamps();

            $table->unsignedBigInteger('compra_fk');
            $table->foreign('compra_fk')->references('id')->on('compras');#->onDelete('cascade');
            $table->unsignedBigInteger('producto_fk');
            $table->foreign('producto_fk')->references('id')->on('productos');#->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
