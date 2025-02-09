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
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('jobField');
            $table->string('mission');
            $table->string('vision');
            $table->date('dateOfCreation');
            $table->string('aboutus');
            $table->string('logo');
            $table->string('phoneNumber')->unique();
            $table->string('website')->unique();
            $table->string('commercialRegister');
            $table->boolean('isAccepted')->default(false);
            $table->integer('jobsNumber')->default(0);
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