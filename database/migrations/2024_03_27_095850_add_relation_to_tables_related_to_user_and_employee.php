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
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->change();
        });

        Schema::table('leaves', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('employee_id')->change();
            $table->foreign('employee_id')->references('id')->on('employees')
            ->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('attendance_employees', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('employee_id')->change();
            $table->foreign('employee_id')->references('id')->on('employees')
            ->cascadeOnDelete()->cascadeOnUpdate();
        });
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users')
            ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->integer('user_id')->change();
            $table->dropForeign(['user_id']);
        });
        Schema::table('leaves', function (Blueprint $table) {
            //
            $table->integer('employee_id')->change();
            $table->dropForeign(['employee_id']);
        });
        Schema::table('attendance_employees', function (Blueprint $table) {
            //
            $table->integer('employee_id')->change();
            $table->dropForeign(['employee_id']);
        });
    }
};
