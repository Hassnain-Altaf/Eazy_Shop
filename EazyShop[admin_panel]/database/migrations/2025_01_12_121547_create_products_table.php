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
            $table->string('productname');  
            $table->string('productdescription');
            $table->string('stockquantity');
            $table->string('totalprice');
            $table->string('discount');
            $table->string('category');
            $table->string('size');
            $table->string('tags');
            $table->string('image');
            $table->enum('status', ['active', 'inactive'])->default('active');      
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
