<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('header_color', 9);
            $table->string('text_color', 9);
            $table->string('background_color', 9);
            $table->string('body_color', 9);
            $table->string('border_color', 9);
            $table->string('a_color', 9);
            $table->string('th_color', 9);
            $table->string('box_color', 9);
            $table->string('contents_color', 9);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
