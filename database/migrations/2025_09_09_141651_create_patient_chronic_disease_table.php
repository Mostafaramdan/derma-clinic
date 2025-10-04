<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_chronic_disease', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('chronic_disease_id')->nullable()->constrained()->cascadeOnDelete();
            $table->date('since')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->unique(['patient_id','chronic_disease_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_chronic_disease');
    }
};
