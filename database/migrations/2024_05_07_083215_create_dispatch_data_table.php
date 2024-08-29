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
        Schema::create('dispatch_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dispatch_id');
            $table->foreign('dispatch_id')->references('id')->on('dispatch_policies')->onDelete('cascade');
            $table->unsignedBigInteger('policy_id');
            $table->foreign('policy_id')->references('id')->on('quotation_policies')->onDelete('cascade');
            $table->longText('meta_key');
            $table->longText('meta_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatch_data');
    }
};
