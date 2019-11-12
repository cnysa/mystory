<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddByUserToDeepPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deep_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('updated_by')->nullable()->after('media');
            $table->unsignedBigInteger('created_by')->nullable()->default(1)->after('media');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deep_posts', function (Blueprint $table) {
            $table->dropColumn(['updated_by', 'created_by']);
        });
    }
}
