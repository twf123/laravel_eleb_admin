<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');//id
            $table->string('shop_name');//店铺名称
            $table->integer('categories_id');//所属分类
            $table->string('shop_img');//店铺图片
            $table->string('brand')->default(0);//品牌
            $table->string('shop_rating')->default(0);;//评分
            $table->tinyInteger('on_time')->default(0);//是否准时到达
            $table->tinyInteger('fengniao')->default(0);//是否蜂鸟
            $table->tinyInteger('bao')->default(0);//是否保标记
            $table->tinyInteger('piao')->default(0);//是否票标记
            $table->tinyInteger('zhun')->default(0);//是否准标记
            $table->decimal('start_send');//20,起送金额
            $table->decimal('send_cost');//5,配送费
            $table->string('distance');//637,距离
            $table->string('estimate_time');//30,预计时间
            $table->string('notice');//店公告
            $table->string('discount');//优惠信息
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_infos');
    }
}
