<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name');
            $table->string('site_description')->nullable();
            $table->tinyInteger('user_create_any')->default(0);
            $table->tinyInteger('user_create_member')->default(0);
            $table->tinyInteger('user_create_admin')->default(1);
            $table->boolean('basic_auth');
            $table->string('basic_user')->nullable();
            $table->string('basic_password')->nullable();
            $table->boolean('anonymous_permission')->default(0);
            $table->integer('header_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
