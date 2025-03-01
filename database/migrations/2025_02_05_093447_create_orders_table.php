<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_pedido')->useCurrent();
            $table->enum('estado', ['Pendiente', 'Enviado', 'Cancelado', 'Pagado'])->default('Pendiente');
            $table->decimal('total', 10, 2);
            $table->foreignId('addresses_id')->constrained('addresses')->onDelete('cascade');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vouchers_id')->nullable()->constrained('vouchers')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
