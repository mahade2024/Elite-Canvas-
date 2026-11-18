<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('user_id')->nullable(); // Nullable for Guest checkout
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('delivery_area'); // This will store the 'Thana'
            $table->text('address');
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            
            // IMPORTANT: Adding this line for bKash/Nagad
            $table->string('transaction_id')->nullable(); 
            
            $table->string('status')->default('pending');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};