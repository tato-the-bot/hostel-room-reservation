<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropForeign('rooms_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign('reservations_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');

            $table->foreign('student_id')->references('id')->on('students');
        });
        
        Schema::table('rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('agent_id');

            $table->foreign('agent_id')->references('id')->on('agents');
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
