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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            /**$table->foreignId('mechanic_id')->nullable()->constrained('mechanics')->onDelete('cascade'); // Add foreign key*/
            $table->string('ProductName');
            $table->text('Description');
            $table->decimal('Price', 8, 2);
            $table->integer('Inventory');
            $table->string('color'); 
            $table->string('width'); 
            $table->string('weight'); 
            $table->string('height'); 
            $table->string('category'); 
            $table->string('image')->nullable(); // to store the shop image path
            $table->foreignId('mechanic_id')->constrained()->onDelete('CASCADE'); // Add foreign key
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
