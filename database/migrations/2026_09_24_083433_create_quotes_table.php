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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->text('note')->nullable();
            $table->enum('status', ['new', 'processing', 'completed', 'canceled'])->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
