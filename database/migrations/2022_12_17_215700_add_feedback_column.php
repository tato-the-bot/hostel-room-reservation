<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeedbackColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->string('role')->nullable();

            $table->foreign('agent_id')->references('id')->on('agents');
            $table->foreign('student_id')->references('id')->on('students');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
