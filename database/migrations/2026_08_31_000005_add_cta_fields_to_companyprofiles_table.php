<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCtaFieldsToCompanyprofilesTable extends Migration
{
    public function up()
    {
        Schema::table('companyprofiles', function (Blueprint $table) {
            $table->string('cta_badge', 150)->nullable()->after('cta_bg');
            $table->string('cta_title', 200)->nullable()->after('cta_badge');
            $table->text('cta_description')->nullable()->after('cta_title');
            $table->string('cta_btn1_text', 100)->nullable()->after('cta_description');
            $table->string('cta_btn1_link', 200)->nullable()->after('cta_btn1_text');
            $table->string('cta_btn2_text', 100)->nullable()->after('cta_btn1_link');
            $table->string('cta_btn2_link', 200)->nullable()->after('cta_btn2_text');
            $table->string('insta_handle', 100)->nullable()->after('cta_btn2_link');
            $table->string('insta_followers', 50)->nullable()->after('insta_handle');
            $table->string('insta_link', 200)->nullable()->after('insta_followers');
        });
    }

    public function down()
    {
        Schema::table('companyprofiles', function (Blueprint $table) {
            $table->dropColumn([
                'cta_badge', 'cta_title', 'cta_description',
                'cta_btn1_text', 'cta_btn1_link', 'cta_btn2_text', 'cta_btn2_link',
                'insta_handle', 'insta_followers', 'insta_link'
            ]);
        });
    }
}
