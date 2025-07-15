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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('assigned')->nullable();
            $table->foreignUuid('file_id')->nullable();
            $table->string('reference')->unique()->index();
            $table->string('name');
            $table->string('job');
            $table->string('tin')->unique()->nullable();
            $table->string('email')->unique()->index();
            $table->string('mobile_phone')->unique()->nullable()->index();
            $table->string('phone_number')->nullable();
            $table->string('alternative_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->date('birthday')->nullable();
            $table->longText('notes')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->datetime('mobile_phone_verified_at')->nullable();
            $table->enum('type', ['individual', 'business'])->default('individual');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
