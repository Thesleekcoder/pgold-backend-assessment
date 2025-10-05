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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'crypto' or 'giftcard'
            $table->string('name'); // e.g., 'BTC', 'Amazon'
            $table->string('country')->nullable();
            $table->string('range')->nullable(); // e.g., '$10-$50'
            $table->string('action'); // 'buy', 'sell', 'redeem'
            $table->decimal('rate', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};