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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamps();
        });

        Schema::create('goal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('progress');
            $table->unsignedInteger('employee_id');
            $table->timestamps();
        });

        Schema::table('goal', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
        Schema::dropIfExists('goal');
    }
};
