<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('role_id');
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('url')->nullable();
            $table->string('name')->nullable();
            $table->string('name_kana')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('password_updated_at')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('group_code', 10)->nullable();
            $table->string('image_file')->nullable();
            $table->string('api_token')->nullable();
            $table->integer('status')->default(\Status::ENABLED);
            $table->rememberToken();
            $table->index(['email']);
            $table->index(['url']);
            $table->index(['birthdate']);
            $table->index(['api_token']);
            $table->index(['remember_token']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
