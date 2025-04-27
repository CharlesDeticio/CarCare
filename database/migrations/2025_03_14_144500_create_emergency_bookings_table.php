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
        Schema::create('emergency_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('mechanic_id')->nullable()->constrained()->onDelete('set null');
            $table->string('emergency_reason');
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->string('emergency_address');
            $table->enum('status', ['pending', 'accepted', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_bookings');
    }
};
