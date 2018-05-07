<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_prizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('events_id')->unsigned();//活动ID
            $table->foreign('events_id')->references('id')->on('events');//外键
            $table->string('prizes_name');//奖品名称
            $table->longText('description');//奖品详情
            $table->integer('member_id');//中奖商家ID
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
        Schema::dropIfExists('event_prizes');
    }
}
