<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resturant_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->string('location');
            $table->decimal('price',8 , 2);
            $table->decimal('delivery_fee', 8, 2);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('tax',8 , 2)->default(0);
            $table->text('notes')->nullable();
            $table->string('voucher')->nullable();
            $table->string('payment_method');
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
