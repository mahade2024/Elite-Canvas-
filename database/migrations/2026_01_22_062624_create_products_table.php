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
            $table->string("name");
            // Changed to decimal (10 digits total, 2 after decimal) and made nullable
            $table->decimal("price", 10, 2)->nullable(); 
            $table->string("category");
            $table->string("gallery"); // This remains your Main Image
            $table->text("description"); // Changed from string to text for more space
            // Adding a type column to easily identify product style
            $table->string("product_type")->default("variable"); 
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