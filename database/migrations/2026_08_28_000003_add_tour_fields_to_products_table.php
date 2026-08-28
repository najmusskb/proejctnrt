<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTourFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('duration', 50)->nullable()->after('price');     // e.g. 2 hours
            $table->string('group_size', 50)->default('Small group')->nullable()->after('duration');
            $table->string('badge_type', 20)->default('bestseller')->nullable()->after('group_size'); // bestseller, popular, new
            $table->decimal('rating', 3, 1)->nullable()->after('badge_type');
            $table->integer('reviews_count')->default(0)->after('rating');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['duration', 'group_size', 'badge_type', 'rating', 'reviews_count']);
        });
    }
}
