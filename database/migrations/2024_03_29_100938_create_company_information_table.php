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
        Schema::create('company_information', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_phone_number')->nullable();
            $table->string('company_email')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->text('address')->nullable();
            $table->text('company_description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_information');
    }
};
