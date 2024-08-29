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
        Schema::create('policy_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_id');
            $table->foreign('policy_id')->references('id')->on('policies')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->longText('commissions')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_types');
    }
};
