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
        Schema::create('shopinventories', function (Blueprint $table) {
            $table->id('PID');
            $table->string('ProductName');
            $table->decimal('Price', 8, 2);
            $table->integer('Inventory');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopinventories');
    }
};
