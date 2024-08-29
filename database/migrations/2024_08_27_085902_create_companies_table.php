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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('email')->nullable();
            $table->string('dialcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('whats_app_dialcode')->nullable();
            $table->string('whats_app')->nullable();
            $table->longText('address_line_1')->nullable();
            $table->longText('address_line_2')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('iso2')->nullable();
            $table->string('gstin')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};