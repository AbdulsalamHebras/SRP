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
        Schema::create('appliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phoneNumber')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->date('DOB')->nullable();
            $table->string('gender')->nullable();
            $table->string('degree')->nullable();
            $table->string('languages')->nullable();
            $table->string('CVfile')->nullable();
            $table->date('graduationDate')->nullable();
            $table->integer('age')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appliers');
    }
};
