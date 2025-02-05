<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingcartProductsTable extends Migration
{
    public function up()
    {
        Schema::create('shoppingcart_products', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->foreignId('shoppingcart_id')->constrained('shoppingcart')->onDelete('cascade');
            $table->foreignId('products_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shoppingcart_products');
    }
}
