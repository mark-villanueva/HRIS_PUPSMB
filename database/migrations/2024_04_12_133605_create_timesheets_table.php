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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employees_id')->constrained('employees')->cascadeOnDelete(); 
            $table->date('date');
            $table->foreignId('schedules_id')->constrained('schedules')->cascadeOnDelete(); 
            $table->time('timein')->nullable(); 
            $table->time('timeout')->nullable();
            $table->unsignedInteger('hours')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timesheets');
    }
};
