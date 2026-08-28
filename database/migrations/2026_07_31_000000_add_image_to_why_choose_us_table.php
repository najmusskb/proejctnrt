<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('why_choose_us', function (Blueprint $table) {
            $table->string('image', 255)->nullable()->after('icon');
        });
    }

    public function down()
    {
        Schema::table('why_choose_us', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
