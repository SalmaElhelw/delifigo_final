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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phonenum');
            $table->string('address');
            $table->enum('role', ['admin', 'customer', 'restaurnt_owner', 'delivery_man'])->default('customer');
            $table->string('visa_number')->nullable();
            $table->string('visa_expiration_date')->nullable();
            $table->string('visa_cvv')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
