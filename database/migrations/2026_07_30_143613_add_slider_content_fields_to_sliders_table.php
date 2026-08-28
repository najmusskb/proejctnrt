<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSliderContentFieldsToSlidersTable extends Migration
{
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('title');
            $table->string('heading')->nullable()->after('subtitle');
            $table->string('button_text', 50)->nullable()->after('link');
            $table->string('button_url')->nullable()->after('button_text');
            $table->string('video_url')->nullable()->after('button_url');
        });
    }

    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'heading', 'button_text', 'button_url', 'video_url']);
        });
    }
}
