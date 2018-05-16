<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('about_me')->nullable();
            $table->char('degree', 64)->nullable();
            $table->char('institution', 112)->nullable();
            $table->char('country', 64)->nullable();
            $table->char('city', 64)->nullable();
            $table->char('phone', 32)->nullable();
            $table->char('occupation', 64)->nullable();
            $table->float('charge')->nullable();
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
            $table->dropColumn('about_me');
            $table->dropColumn('degree');
            $table->dropColumn('institution');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('phone');
        });
    }
}
