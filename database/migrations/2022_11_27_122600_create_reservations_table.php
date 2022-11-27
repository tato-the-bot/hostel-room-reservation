<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); 
            $table->string('student_id');
            $table->string('room_id');
            $table->string('tranaction_id');
            $table->timestamps('contract_start_date');
            $table->timestamps('contract_end_date');
            $table->string('remark');
            $table->boolean('status');      
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('room_id')->references('id')->on('room_categories');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
