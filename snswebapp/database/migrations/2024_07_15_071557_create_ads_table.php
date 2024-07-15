<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('type');
            $table->string('title', 30)->nullable();
            $table->mediumtext('body');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->timestamps();
            $table->primary(['id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
