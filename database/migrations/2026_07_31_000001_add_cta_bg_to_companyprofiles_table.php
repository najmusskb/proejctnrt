<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('companyprofiles', function (Blueprint $table) {
            $table->string('cta_bg', 255)->nullable()->after('logo');
        });
    }

    public function down()
    {
        Schema::table('companyprofiles', function (Blueprint $table) {
            $table->dropColumn('cta_bg');
        });
    }
};
