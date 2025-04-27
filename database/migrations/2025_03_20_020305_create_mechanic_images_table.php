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
        Schema::create('mechanic_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mechanic_id')->constrained('mechanics')->onDelete('cascade');
            $table->string('image_path'); // To store image filename or path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mechanic_images');
    }
};
