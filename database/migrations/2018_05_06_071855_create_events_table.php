<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');//活动的名称
            $table->string('content');//详情
            $table->string('signup_start');//报名开始时间
            $table->string('signup_end');//报名结束时间
            $table->string('prize_date');//开奖日期
            $table->string('signup_num');//活动人数限制
            $table->string('is_prize')->default(0);//是否已开奖
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
        Schema::dropIfExists('events');
    }
}
