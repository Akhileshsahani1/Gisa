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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_type')->nullable();
            $table->string('salutation')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('dialcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('whats_app_dialcode')->nullable();
            $table->string('whats_app')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('lead_source')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')->references('id')->on('administrators')->onDelete('cascade');
            $table->string('lead_status')->nullable();
            $table->unsignedBigInteger('policy_id')->nullable();
            $table->foreign('policy_id')->references('id')->on('policies')->onDelete('cascade');
            $table->unsignedBigInteger('policy_type_id')->nullable();
            $table->foreign('policy_type_id')->references('id')->on('policy_types')->onDelete('cascade');
            $table->date('previous_policy_expiry_date')->nullable();
            $table->longText('special_remark')->nullable();
            $table->string('contacted_via')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('customer_type')->default('inword');
            $table->string('seen_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
