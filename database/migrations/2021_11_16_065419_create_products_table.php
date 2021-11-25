<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('manufacturer');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('price_sale')->nullable()->default(0);
            $table->boolean('status')->default(0);
            $table->text('content')->nullable();
            $table->text('detail')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('img_list')->nullable();
            $table->unsignedInteger('count_in_sock')->default(0);
            $table->unsignedInteger('rate')->default(0);
            $table->unsignedInteger('count')->default(0);
            $table->foreignId('category_id')->constrained('categories');
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
    }
}
