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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('mechanic_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('status')->default('pending'); // pending, in_transit, completed
            $table->string('cancellation_reason')->nullable();
            $table->decimal('total_amount', 8, 2);
            $table->string('status_msg')->default('Order has been placed.');
            $table->string('payment_method')->nullable(); // Add payment_method column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('payment_method'); // Drop payment_method column
            $table->dropColumn('cancellation_reason');
        });
    }
};
