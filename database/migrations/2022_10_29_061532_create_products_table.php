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
            $table->foreignId('category_id')
            ->constrained('categories')
            ->onDelete('cascade');
            $table->foreignId('brand_id')
            ->constrained('brands')
            ->onDelete('cascade');
            $table->string('name', 100);
            $table->string('product_code', 7)->nullable();
            $table->string('slug');
            $table->decimal('price', 18,2)->nullable();
            $table->longText('description');
            $table->boolean('is_hot')->nullable();
            $table->string('image');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->string('ip_address')->nullable();
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
