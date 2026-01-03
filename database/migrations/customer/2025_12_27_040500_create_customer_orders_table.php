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
    Schema::create('customer_orders', function (Blueprint $table) {
    $table->id();
    $table->integer('customer_id');
    $table->string('order_number')->unique();
    $table->decimal('total_amount', 12, 2);
    $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled']);
    $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
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
