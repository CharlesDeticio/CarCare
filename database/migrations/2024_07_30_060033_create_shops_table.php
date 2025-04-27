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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mechanic_id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('image')->nullable(); // to store the shop image path
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('mechanic_id')->references('id')->on('mechanics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
