<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeathersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weathers', function (Blueprint $table) {
            $table->integer('city_id');
            $table->dateTime('time');
            $table->string('weather_id');
            $table->string('weather_main');
            $table->string('weather_text');
            $table->string('weather_icon');
            $table->integer('clouds');
            $table->double('temp');
            $table->double('wind_speed')->nullable();
            $table->double('rain')->nullable();
            $table->double('snow')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['city_id', 'time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weathers');
    }
}
