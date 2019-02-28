<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('payer_id')->unsigned();
            $table->integer('recipient_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->integer('payer_balance')->unsigned();
            $table->integer('recipient_balance')->unsigned();
            $table->timestamp('performed_at');

            $table->foreign('payer_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('recipient_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
