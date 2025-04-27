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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained()->onDelete('cascade'); // Link to products
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('mechanic_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade'); // Link to products
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('cascade'); // Link to products
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade'); // Link to products
            $table->unsignedBigInteger('product_rating_id')->nullable();
            $table->unsignedBigInteger('service_rating_id')->nullable();



        $table->string('message');
        // $table->string('mechanic_message')->nullable(); // ✅ New column for mechanics' messages
        $table->boolean('is_read')->default(false); // Read or Unread
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
