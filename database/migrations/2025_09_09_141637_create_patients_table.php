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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('ref_code')->unique()->index(); // مثل P-10234 (للباركود/QR)
            $table->string('name');
            $table->unsignedTinyInteger('age_years')->nullable();  // 0..150
            $table->unsignedTinyInteger('age_months')->nullable(); // 0..11
            $table->enum('gender', ['male','female','other'])->nullable();
            $table->enum('marital_status', ['single','married','other'])->nullable();
            $table->string('occupation')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable()->index();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
