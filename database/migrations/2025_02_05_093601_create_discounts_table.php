<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->text('description')->nullable();
            $table->enum('tipo', ['global', 'categoria', 'producto']);
            $table->decimal('valor', 10, 2);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->foreignId('products_id')->nullable()->constrained('products')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
