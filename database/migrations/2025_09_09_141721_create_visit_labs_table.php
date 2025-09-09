<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_labs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained()->cascadeOnDelete();
            $table->string('test_name');           // CBC, LFTs ...
            $table->string('notes')->nullable();   // صيام, وقت, ...
            $table->string('lab_info')->nullable()->default('المعمل : القصر العيني');
            // لو هنسجّل ملفات النتائج في جدول الملفات العام، حط reference هنا:
            $table->foreignId('result_file_id')->nullable()->constrained('visit_files')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_labs');
    }
};
