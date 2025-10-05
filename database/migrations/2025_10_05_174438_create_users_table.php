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
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('country_code')->default('+234');
            $table->string('referral_code')->nullable();
            $table->string('source')->nullable();
            $table->string('password');
            $table->string('email_verification_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('face_id_enabled')->default(false);
            $table->string('selfie_url')->nullable();
            $table->boolean('identity_verified')->default(false);
            $table->boolean('fingerprint_enabled')->default(false);
            $table->timestamp('onboarding_completed_at')->nullable();
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