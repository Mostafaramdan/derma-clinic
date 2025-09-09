<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_medications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained()->cascadeOnDelete();
            $table->string('drug_name');
            $table->string('strength')->nullable();
            $table->unsignedTinyInteger('times_per_day')->nullable(); // 1..20
            $table->unsignedTinyInteger('every_hours')->nullable();   // 1..72 (لدعم 48 ساعة)
            $table->unsignedSmallInteger('duration_days')->default(7);
            $table->string('instructions')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_medications');
    }
};
