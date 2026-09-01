<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExpandAboutsTable extends Migration
{
    public function up()
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->string('subtitle', 150)->nullable()->after('title');
            $table->text('mission')->nullable()->after('subtitle');
            $table->string('image2')->nullable()->after('image');
            $table->json('checkmarks')->nullable()->after('image2');
            $table->string('button_text', 100)->nullable()->after('checkmarks');
            $table->string('button_link', 200)->nullable()->after('button_text');
            $table->string('button2_text', 100)->nullable()->after('button_link');
            $table->string('button2_link', 200)->nullable()->after('button2_text');
            $table->string('counter1_number', 50)->nullable()->after('button2_link');
            $table->string('counter1_label', 100)->nullable()->after('counter1_number');
            $table->string('counter2_number', 50)->nullable()->after('counter1_label');
            $table->string('counter2_label', 100)->nullable()->after('counter2_number');
            $table->string('badge_number', 20)->nullable()->after('counter2_label');
            $table->string('badge_label', 50)->nullable()->after('badge_number');
        });
    }

    public function down()
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'subtitle', 'mission', 'image2', 'checkmarks',
                'button_text', 'button_link', 'button2_text', 'button2_link',
                'counter1_number', 'counter1_label', 'counter2_number', 'counter2_label',
                'badge_number', 'badge_label'
            ]);
        });
    }
}
