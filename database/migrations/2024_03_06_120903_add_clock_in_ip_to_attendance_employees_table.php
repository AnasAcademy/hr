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
                $table->unsignedBigInteger('clock_in_ip')->nullable();
                $table->foreign('clock_in_ip')->references('id')->on('ip_restricts')
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
            $table->dropForeign(['clock_in_ip']);
            $table->dropColumn('clock_in_ip');
        });
    }
};
