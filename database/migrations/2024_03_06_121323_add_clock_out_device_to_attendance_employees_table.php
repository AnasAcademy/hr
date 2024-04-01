<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('attendance_employees', function (Blueprint $table) {
            //
            Schema::table('attendance_employees', function (Blueprint $table) {
                $table->unsignedBigInteger('clock_out_device')->nullable();
                $table->foreign('clock_out_device')->references('id')->on('user_devices')
                ->nullOnDelete()->cascadeOnUpdate();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_employees', function (Blueprint $table) {
            //
            $table->dropForeign(['clock_out_device']);
            $table->dropColumn('clock_out_device');
        });
    }
};
