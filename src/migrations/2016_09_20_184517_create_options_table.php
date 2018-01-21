<?php

use Verkoo\Common\Entities\Customer;
use Verkoo\Common\Entities\Options;
use Verkoo\Common\Entities\Payment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cash_customer');
            
            $table->foreign('cash_customer')
                ->references('id')
                ->on('customers');

            $table->unsignedInteger('payment_id');

            $table->foreign('payment_id')
                ->references('id')
                ->on('payments');

            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('cif')->nullable();
            $table->string('phone')->nullable();
            $table->string('default_printer')->nullable();
            $table->string('cp')->nullable();
            $table->string('city')->nullable();
            $table->string('web')->nullable();
            $table->boolean('print_ticket_when_cash')->default(0);
            $table->boolean('open_drawer_when_cash')->default(1);
            $table->boolean('hide_out_of_stock')->default(0);
            $table->boolean('show_stock_in_photo')->default(0);
            $table->boolean('recount_stock_when_open_cash')->default(0);
            $table->boolean('break_down_taxes_in_ticket')->default(0);
            $table->unsignedInteger('tax_id');
            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->integer('pagination')->nullable();
            $table->boolean('manage_kitchens')->default(0);
            $table->unsignedInteger('default_tpv_serie')->default(1);
            $table->boolean('cash_pending_ticket')->default(0);
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
        Schema::drop('options');
    }
}
