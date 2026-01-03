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
      Schema::create('customer_addresses', function (Blueprint $table) {
    $table->id();
    $table->integer('customer_id');
    $table->enum('type', ['shipping', 'billing'])->default('shipping');
    $table->string('country');
    $table->string('city');
    $table->text('address');
    $table->string('postal_code')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
