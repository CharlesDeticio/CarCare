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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // $table->string('input_address');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->string('reason')->nullable();
            $table->string('status_msg')->default('Booking has been placed.');
            $table->string('status')->default('pending'); // pending, in_transit, completed
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('mechanic_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade'); // Link to services
            $table->boolean('hasRated')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
