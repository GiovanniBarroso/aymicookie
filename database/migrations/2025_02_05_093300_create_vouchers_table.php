<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id(); // Asegúrate de que el ID es BIGINT
            $table->string('codigo', 50)->unique();
            $table->text('descripcion')->nullable();
            $table->decimal('valor', 10, 2);
            $table->enum('tipo', ['1', '2', '3']);
            $table->boolean('activo')->default(true);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
};
