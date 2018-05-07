<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('order_code');
            $table->string('order_birth_tim');
            $table->integer('order_status');
            $table->integer('shop_id');
            $table->string('shop_name');
            $table->string('shop_img');
            $table->bigInteger('order_price');
            $table->string('provence');
            $table->string('city');
            $table->string('area');
            $table->string('detail_address');
            $table->string('tel');
            $table->string('receiver');
            $table->integer('user_id')->unsigned();//用户id
            $table->foreign('user_id')->references('id')->on('users');//外键
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
        Schema::dropIfExists('orders');
    }
}
