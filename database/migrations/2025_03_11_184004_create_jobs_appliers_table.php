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
        Schema::create('jobs_appliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applier_id')->constrained('appliers')->cascadeOnDelete();
            $table->foreignId('job_id')->constrained('jobs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_appliers');
    }
};
