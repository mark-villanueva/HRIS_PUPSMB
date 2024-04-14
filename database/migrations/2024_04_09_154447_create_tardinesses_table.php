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
        Schema::create('tardinesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('graceperiod')->nullable(); 
            $table->unsignedInteger('startdeducting')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tardinesses');
    }
};
