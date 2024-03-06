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
        Schema::table('ip_restricts', function (Blueprint $table) {
            $table->unsignedBigInteger('belongs_to')->nullable();
            $table->foreign('belongs_to')->references('id')->on('users')
            ->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ip_restricts', function (Blueprint $table) {
            //
            $table->dropForeign(['belongs_to']);
            $table->dropColumn('belongs_to');
        });
    }
};
