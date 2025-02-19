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
        Schema::create('cartproducts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // If the user is deleted, their cart is also deleted
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // If the product is deleted, it is also removed from cart
            $table->integer('quantity')->default(1); // To store the quantity of the product in the cart
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartproducts');
    }
};
