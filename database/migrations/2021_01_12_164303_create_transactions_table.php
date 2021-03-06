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
            $table->id();
            $table->Integer('transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->Integer('reciever_id');
            $table->Integer('amount');
            $table->longText('description');
            $table->text('title');
            $table->enum('transaction_type', ['send', 'recieve', 'request']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');  
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
