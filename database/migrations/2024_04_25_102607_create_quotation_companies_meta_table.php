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
        Schema::create('quotation_companies_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quotation_company_id');
            $table->unsignedBigInteger('quotation_id');
            $table->foreign('quotation_company_id')->references('id')->on('quotation_companies')->onDelete('cascade');
            $table->longText('meta_key')->nullable();
            $table->longText('meta_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_groups_meta');
    }
};
