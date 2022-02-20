<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\Table\Table;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku')->unique();
            $table->string('title');
            $table->double('price', 10,2);
            $table->integer('stock');
            $table->string('added_via');
            $table->string('removed_via')->nullable();
            $table->text('description');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('image_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');

            $table->string('path');
            $table->timestamps();
        });

        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');

            $table->enum('type', ['Entrada', 'Saída']);
            $table->integer('amount');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('image_product');
        Schema::dropIfExists('stocks');
    }
}
