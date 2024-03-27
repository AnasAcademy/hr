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
        Schema::table('leaves', function (Blueprint $table) {
            $table->unsignedBigInteger('leave_type_id')->change();
            $table->foreign('leave_type_id')->references('id')->on('leave_types')
            ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leaves', function (Blueprint $table) {
            //
            $table->integer('leave_type_id')->change();
            $table->dropForeign(['leave_type_id']);
        });
    }
};
