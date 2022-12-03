<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Student;

class CreateOtpCodeColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('otp_code')->nullable();
        });

        Schema::table('agents', function (Blueprint $table) {
            $table->string('otp_code')->nullable();
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->string('otp_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('otp_code');
        });

        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn('otp_code');
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('otp_code');
        });
    }
}
