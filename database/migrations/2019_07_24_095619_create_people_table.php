<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tel')->default('')->comment('手机');
            $table->string('name')->default('')->comment('姓名');
            $table->integer('member_id')->default(0)->comment('member_id');
            $table->char('order_no',250)->default('')->comment('客户订单号');
            $table->char('trade_no',250)->default('')->comment('平台流水号');
            $table->tinyInteger('status')->default(0)->comment('0失败 1成功');
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
        Schema::dropIfExists('people');
    }
}
