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
            $table->increments('idusers');
            $table->string('name');
            $table->string('email')->unique();
            $table->tinyInteger('role')->default(1);
            $table->tinyInteger('role_create')->default(0);
            $table->tinyInteger('role_update')->default(0);
            $table->tinyInteger('role_delete')->default(0);
            $table->tinyInteger('role_read')->default(0);
            $table->tinyInteger('role_print')->default(0);
            $table->tinyInteger('role_approve')->default(0);
            $table->enum('role_type',['GA','RO','LD']);
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
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
