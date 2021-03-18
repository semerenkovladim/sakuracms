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
            $table->id();
            $table->string('email', 255)->unique();
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('password', 60);
            $table->string('remember_token', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->boolean('is_admin')->default(false);
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('country_id')->on('countries')->references('id')->onDelete('set null');
            $table->foreign('role_id')->on('roles')->references('id')->onDelete('set null');
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
