<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->char('institution', 128);
            $table->char('website', 128)->nullable();
            $table->char('degree', 128);
            $table->char('subject', 64)->nullable();
            $table->char('country', 64)->nullable();
            $table->char('city', 64)->nullable();
            $table->char('from_year', 8)->nullable();
            $table->char('from_month', 32)->nullable();
            $table->char('to_year', 8)->nullable();
            $table->char('to_month', 32)->nullable();
            $table->longText('details', 32)->nullable();
            $table->boolean('is_continue')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
}
