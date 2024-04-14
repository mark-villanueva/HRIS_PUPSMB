<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Not Yet Migrated
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employeenumber');
            $table->string('fullname');
            $table->foreignId('offices_id')->constrained('offices')->cascadeOnDelete(); 
            $table->foreignId('departments_id')->constrained('departments')->cascadeOnDelete(); 
            $table->foreignId('employmenttypes_id')->constrained('employment_types')->cascadeOnDelete();
            $table->string('biometric')->nullable();  
            $table->unsignedInteger('basicsalary')->nullable(); 
            $table->boolean('minimumwage'); 
            $table->string('payrollgroup'); 
            $table->unsignedInteger('tinnumber')->nullable();  
            $table->unsignedInteger('sssnumber')->nullable();  
            $table->unsignedInteger('philhealthnumber')->nullable();  
            $table->unsignedInteger('hdmf')->nullable(); 
            $table->boolean('timesheetrequired');  
            $table->boolean('holidaypay');  
            $table->boolean('specialholidaypay');  
            $table->boolean('premiumholidaypay');  
            $table->boolean('restdaypay'); 
            $table->boolean('overtime'); 
            $table->boolean('deminimis');  
            $table->boolean('nightdifferential');  
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};









