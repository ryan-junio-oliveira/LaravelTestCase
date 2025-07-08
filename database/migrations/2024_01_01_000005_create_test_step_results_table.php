<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_step_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_execution_id')->constrained()->onDelete('cascade');
            $table->foreignId('test_step_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'passed', 'failed', 'blocked'])->default('pending');
            $table->text('actual_result')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_step_results');
    }
};