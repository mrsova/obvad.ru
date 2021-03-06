<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('uids')->nullable();
            $table->string('name')->nullable();
            $table->string('login')->nullable();
            $table->string('vk_url')->nullable();
            $table->string('email')->nullable();
            $table->string('reset_token_pass')->nullable();
            $table->string('password')->nullable();
            $table->integer('is_admin')->default(0);
            $table->integer('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
