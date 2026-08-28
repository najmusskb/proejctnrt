<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('subtitle', 200)->nullable();
            $table->string('image')->nullable();
            $table->string('badge_label', 50)->nullable(); // e.g. FULL DAY, HALF DAY
            $table->string('badge_icon', 50)->nullable();  // e.g. 🏛️ Ancient Rome
            $table->decimal('price', 10, 2)->nullable();
            $table->text('highlights')->nullable(); // JSON array of highlight tags
            $table->boolean('is_active')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
