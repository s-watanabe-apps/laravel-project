<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visited_users', function (Blueprint $table) {
            $table->date('date');
            $table->bigInteger('user_id');
            $table->bigInteger('visited_id');
            $table->timestamps();
            $table->primary(['date', 'user_id', 'visited_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visited_users');
    }
}
