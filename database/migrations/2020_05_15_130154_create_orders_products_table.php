<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->id()->comment('Идентификатор состава заказа');
            $table->bigInteger('order_id')
                ->unsigned()
                ->nullable(false)
                ->comment('Идентификатор заказа, которому принадлежит товар');
            $table->bigInteger('product_id')
                ->unsigned()
                ->nullable(false)
                ->comment('Идентификатор товара из определённого заказа');
            $table->timestamps();


            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_products');
    }
}
