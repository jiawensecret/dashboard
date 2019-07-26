<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('')->comment('昵称');
            $table->string('username')->unique()->comment('用户名');
            $table->string('email')->default('')->unique();
            $table->string('password')->default(0);
            $table->string('member_id')->default(0);
            $table->string('tel')->default('')->comment('手机');
            $table->tinyInteger('is_super')->default(0)->comment('是否为超级管理员');
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
        Schema::dropIfExists('admins');
    }
}
