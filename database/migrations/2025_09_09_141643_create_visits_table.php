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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('visit_type_id')->nullable()->constrained()->nullOnDelete();

            $table->string('visit_code')->unique()->index(); // كود زيارة داخلي (اختياري)
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete(); // الطبيب
            $table->enum('status', ['draft','final'])->default('draft');

            // الكشف (من UI)
            $table->enum('skin_type', ['I','II','III','IV','V','VI'])->nullable();
            $table->string('chief_complaint')->nullable();
            $table->enum('severity', ['1','2','3','4'])->nullable();
            $table->enum('duration_bucket', ['<1m','1-3m','3-6m','6-12m','>12m'])->nullable();
            $table->string('onset')->nullable();
            $table->enum('course', ['continuous','relapsing','improving','worsening'])->nullable();
            $table->json('diagnosis')->nullable();
            $table->string('clinical_picture')->nullable();
            $table->date('follow_up_on')->nullable();

            // Body Picker spots (JSON من الواجهة)
            $table->json('body_spots')->nullable(); // [{id,x,y,name,key,view?}, ...]

            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    // Drop dependent tables first to avoid foreign key constraint errors
    Schema::dropIfExists('visit_advices');
    Schema::dropIfExists('visit_files');
    Schema::dropIfExists('visit_labs');
    Schema::dropIfExists('visit_medications');
    Schema::dropIfExists('visit_services');
    Schema::dropIfExists('visits');
    }
};
