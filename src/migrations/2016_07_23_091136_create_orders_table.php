<?php

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
            $table->increments('id');
            $table->date('date');
            $table->string('number');
            $table->unsignedInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('session_id')->unsigned()->nullable();
            $table->integer('quote_id')->unsigned()->nullable();
            $table->foreign('quote_id')->references('id')->on('quotes');
            $table->integer('table_id')->unsigned()->nullable();
            $table->integer('cashed_amount')->default(0);
            $table->unsignedInteger('serie')->default(1);
            $table->integer('discount')->default(0);
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
        Schema::drop('orders');
    }
}
