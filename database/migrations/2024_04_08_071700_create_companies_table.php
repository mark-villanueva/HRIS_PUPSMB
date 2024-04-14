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
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->string('tradename');
            $table->string('type'); 
            $table->unsignedInteger('tin')->nullable();
            $table->unsignedInteger('rdo')->nullable();
            $table->unsignedInteger('sss')->nullable();
            $table->unsignedInteger('hdmf')->nullable();
            $table->unsignedInteger('philhealth')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
