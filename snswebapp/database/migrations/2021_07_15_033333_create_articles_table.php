<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->char('lang', 2)->default(app()->getLocale());
            $table->string('key', 256)->nullable();
            $table->integer('type');
            $table->integer('status');
            $table->string('title');
            $table->mediumtext('body');
            $table->string('link')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['lang', 'key']);
            $table->index(['user_id']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
