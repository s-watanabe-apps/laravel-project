<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePictureCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('picture_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comment');
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
            $table->index(['picture_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('picture_comments');
    }
}
