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
       Schema::create('customer_profiles', function (Blueprint $table) {
    $table->id();
    $table->string('customer_name');
    $table->string('photos')->nullable();
     $table->string("email")->nullable();
    $table->enum('gender', ['male', 'female', 'other'])->nullable();
    $table->date('date_of_birth')->nullable();
    $table->string('phone')->nullable();
    $table->string('password');
    $table->integer('total_orders')->default(0);
    $table->decimal('total_spent', 12, 2)->default(0);
    $table->enum('customer_type', ['new', 'returning', 'loyal', 'vip'])->default('new');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_profiles');
    }
};
