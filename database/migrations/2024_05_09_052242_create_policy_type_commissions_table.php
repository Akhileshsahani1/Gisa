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
        Schema::create('policy_type_commissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('policy_type_id');

            $table->bigInteger('policy_id');

            $table->string('company_name')->nullable();
            $table->string('commissions_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_type_commissions');
    }
};
