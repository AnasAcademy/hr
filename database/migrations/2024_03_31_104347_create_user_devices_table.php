<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_devices', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('date');
            $table->json('Details');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('approved_by')->nullable()->references('id')->on('users')
            ->nullOnDelete()->cascadeOnUpdate();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_devices');
    }
};
