<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('user_id')->unsigned;
            $table->string('code_payment');
            $table->string('code_transaction');
            $table->Integer('total_item')->unsigned;
            $table->bigInteger('total_price')->unsigned;
            $table->Integer('code_unique')->unsigned;
            $table->string('status')->nullable();
            $table->string('resit')->nullable();
            $table->string('courier')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('detail_location')->nullable();
            $table->string('description')->nullable();
            $table->string('method')->nullable();

            $table->timestamp('expired_at')->nullable();
            $table->timestamps();

            $table->string('ship_method');
            $table->bigInteger('total_transfer')->unsigned;
            $table->string('bank');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
