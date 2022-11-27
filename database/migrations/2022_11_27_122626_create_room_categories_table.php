<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_categories', function (Blueprint $table) {
            $table->id();
            $table->string('agent_id');
            $table->string('room_type');
            $table->longText('room_desc');
            $table->double('monthly_rental', 8, 2);
            $table->double('deposit', 8, 2);
            $table->string('image');
            $table->string('remark');
            $table->boolean('status');
            $table->timestamps();

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
        Schema::dropIfExists('room_categories');
    }
}
