<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToGalleriesTable extends Migration
{
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('section', 50)->nullable()->after('title');
            $table->integer('likes')->default(0)->after('section');
            $table->integer('comments')->default(0)->after('likes');
            $table->string('span', 50)->nullable()->after('comments');
        });
    }

    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['section', 'likes', 'comments', 'span']);
        });
    }
}
