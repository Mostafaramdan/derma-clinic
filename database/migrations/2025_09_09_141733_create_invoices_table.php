<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->unique()->constrained()->cascadeOnDelete();
            $table->enum('payment_method', ['cash','transfer'])->default('cash');
            $table->unsignedInteger('subtotal')->default(0); // مجموع بنود visit_services
            $table->unsignedInteger('discount_amount')->default(0);
            $table->string('discount_reason')->nullable();
            $table->unsignedInteger('total')->default(0); // subtotal - discount
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
