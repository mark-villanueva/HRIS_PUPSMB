<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportsTable extends Migration
{
    public function up()
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('exporter');
            $table->integer('total_rows')->default(0);
            $table->string('file_disk');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exports');
    }
}
