<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('dest_subtitle')->nullable();
            $table->string('dest_title')->nullable();
            $table->text('dest_desc')->nullable();

            $table->string('tours_subtitle')->nullable();
            $table->string('tours_title')->nullable();
            $table->text('tours_desc')->nullable();
            $table->string('tours_btn')->nullable();

            $table->string('cat_subtitle')->nullable();
            $table->string('cat_title')->nullable();
            $table->text('cat_desc')->nullable();

            $table->string('pkg_subtitle')->nullable();
            $table->string('pkg_title')->nullable();
            $table->text('pkg_desc')->nullable();

            $table->string('srv_subtitle')->nullable();
            $table->string('srv_title')->nullable();
            $table->text('srv_desc')->nullable();
            $table->string('srv_btn')->nullable();

            $table->string('wcu_subtitle')->nullable();
            $table->string('wcu_title')->nullable();
            $table->text('wcu_desc')->nullable();

            $table->string('partners_subtitle')->nullable();
            $table->string('partners_title')->nullable();

            $table->string('blog_subtitle')->nullable();
            $table->string('blog_title')->nullable();
            $table->text('blog_desc')->nullable();

            $table->string('testi_subtitle')->nullable();
            $table->string('testi_title')->nullable();

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
        Schema::dropIfExists('home_page_settings');
    }
}
