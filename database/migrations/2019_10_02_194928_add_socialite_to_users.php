<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialiteToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname', 20)->nullable()->after('email_verified_at');
            $table->string('avatar')->nullable()->after('nickname');
            $table->char('provider', 10)->nullable()->after('avatar');
            $table->string('provider_id')->nullable()->after('provider');
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nickname', 'avatar', 'provider', 'provider_id']);
        });
    }
}
