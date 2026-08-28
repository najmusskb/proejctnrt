<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCounterFieldsToCompanyprofilesTable extends Migration
{
    public function up()
    {
        Schema::table('companyprofiles', function (Blueprint $table) {
            $table->string('counter1_icon', 50)->default('fas fa-users')->after('map');
            $table->string('counter1_number', 30)->default('1,658+')->after('counter1_icon');
            $table->string('counter1_label', 100)->default('Happy Customers')->after('counter1_number');
            $table->string('counter2_icon', 50)->default('fas fa-cogs')->after('counter1_label');
            $table->string('counter2_number', 30)->default('254+')->after('counter2_icon');
            $table->string('counter2_label', 100)->default('Project Complete')->after('counter2_number');
            $table->string('counter3_icon', 50)->default('fas fa-user-shield')->after('counter2_label');
            $table->string('counter3_number', 30)->default('2M+')->after('counter3_icon');
            $table->string('counter3_label', 100)->default('Registered Member')->after('counter3_number');
            $table->string('counter4_icon', 50)->default('fas fa-trophy')->after('counter3_label');
            $table->string('counter4_number', 30)->default('12+')->after('counter4_icon');
            $table->string('counter4_label', 100)->default('Years Experience')->after('counter4_number');
        });
    }

    public function down()
    {
        Schema::table('companyprofiles', function (Blueprint $table) {
            $table->dropColumn([
                'counter1_icon', 'counter1_number', 'counter1_label',
                'counter2_icon', 'counter2_number', 'counter2_label',
                'counter3_icon', 'counter3_number', 'counter3_label',
                'counter4_icon', 'counter4_number', 'counter4_label',
            ]);
        });
    }
}
