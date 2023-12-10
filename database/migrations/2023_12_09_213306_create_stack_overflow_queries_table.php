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
        Schema::create('stack_overflow_queries', function (Blueprint $table) {
            $table->id();
            $table->text('tagged');
            $table->bigInteger('to_date')->nullable();
            $table->bigInteger('from_date')->nullable();
            $table->json('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stack_overflow_queries');
    }
};
