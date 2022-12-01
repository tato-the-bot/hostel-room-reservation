<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Transaction;


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
            $table->unsignedBigInteger('reservation_id');
            $table->string('transaction_no');
            $table->string('invoice_no');
            $table->string('pay_method');
            $table->double('amount', 8, 2);
            $table->integer('status')->default(Transaction::PAYMENT_TYPE_IN_PROGRESS);
            $table->timestamps();

            $table->foreign('reservation_id')->references('id')->on('reservations');
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
