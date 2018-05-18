<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->char('title', 255);
            $table->char('sub_title', 255)->nullable();
            $table->text('description')->nullable();
            $table->char('language')->nullable();
            $table->boolean('is_test')->default(false);
            $table->char('status', 32)->default('draft');
            $table->text('tools_required')->nullable();
            $table->text('who_can_take')->nullable();
            $table->text('achivement')->nullable();
            $table->char('image', 255)->nullable();
            $table->char('promo_video', 255)->nullable();
            $table->char('price_currency', 32)->nullable();
            $table->float('price')->nullable();
            $table->char('discount_currency', 32)->nullable();
            $table->float('discount_price')->nullable();
            $table->text('welcome_message')->nullable();
            $table->text('congratulation_message')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
