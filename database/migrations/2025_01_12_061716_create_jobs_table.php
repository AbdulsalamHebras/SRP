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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('jobName');
            $table->text('description');
            $table->string('jobType');
            $table->integer('minSalary');
            $table->integer('maxSalary');
            $table->string('currency');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->text('requirements');
            $table->date('expirationDate');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
