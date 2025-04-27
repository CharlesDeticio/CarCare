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
        Schema::create('mechanic_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mechanic_id')->constrained('mechanics')->onDelete('cascade');
            
            // Summary fields
            $table->integer('total_users_booked');
            $table->integer('total_orders');
            $table->integer('total_product_inventory');
            $table->integer('remaining_inventory');
            $table->integer('total_services');

            // Optional: you can store additional info like total revenue, etc.
            $table->decimal('total_revenue', 10, 2)->nullable();

            // PDF file path if you want to save it
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mechanic_reports');
    }
};
