<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            $table->string('service_name'); // snapshot للاسم وقت الزيارة
            $table->unsignedInteger('price'); // السعر الفعلي (قد يختلف عن الافتراضي)
            $table->unsignedInteger('qty')->default(1);
            $table->unsignedInteger('line_total'); // price * qty
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('visit_services');
    }
};
