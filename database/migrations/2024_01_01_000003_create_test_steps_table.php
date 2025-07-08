<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_case_id')->constrained()->onDelete('cascade');
            $table->integer('step_number');
            $table->text('action');
            $table->text('expected_result');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_steps');
    }
};