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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('policy_id')->nullable();
            $table->foreign('policy_id')->references('id')->on('policies')->onDelete('cascade');
            $table->unsignedBigInteger('policy_type_id')->nullable();
            $table->foreign('policy_type_id')->references('id')->on('policy_types')->onDelete('cascade');
            $table->string('pre_inspection_report')->nullable();
            $table->unsignedBigInteger('sales_executive_id')->nullable();
            $table->unsignedBigInteger('service_executive_id')->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('invoice_copy')->nullable();
            $table->string('policy_copy')->nullable();
            $table->string('other_file')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_status')->default('Not Paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
