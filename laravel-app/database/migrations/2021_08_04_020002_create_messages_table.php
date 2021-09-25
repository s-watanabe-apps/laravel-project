<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id');
            $table->integer('message_id');
            $table->string('subject');
            $table->text('body');
            $table->boolean('readed')->default(false);
            $table->unsignedBigInteger('replied_id')->default(0);
            $table->boolean('enable')->default(true);
            $table->datetime('disabled_time')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['from_user_id']);
            $table->index(['to_user_id']);
            $table->unique(['to_user_id', 'message_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
