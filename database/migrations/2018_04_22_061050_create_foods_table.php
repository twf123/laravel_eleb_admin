<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//菜名
            $table->decimal('price');//价格
            $table->string('intro');//介绍
            $table->string('cover');//图片
            $table->tinyInteger('rating')->default(0);//评分
            $table->integer('month_sales')->default(0);//月销售额
            $table->integer('rating_count')->default(0);//评级数
            $table->integer('satisfy_count')->default(0);
            $table->integer('satisfy_rate')->default(0);
//添加和菜品分类的外键
            $table->integer('dishes_id')->unsigned();//菜品分类id
            $table->foreign('dishes_id')->references('id')->on('dishes');//外键
//添加和商家的外键
            $table->integer('member_info_id')->unsigned();//商品ID
            $table->foreign('member_info_id')->references('id')->on('member_info');//外键
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
