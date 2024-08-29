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
            $table->id();
            $table->string('customer_type')->nullable();
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
            $table->date('date_of_anniversary')->nullable();
            $table->string('address')->nullable();
            $table->text('gst_no')->nullable();
            $table->text('pan_no')->nullable();
            $table->string('source')->nullable();
            $table->string('pancard_file')->nullable();
            $table->string('gst_file')->nullable();
            $table->string('aadhar')->nullable();
            $table->string('other')->nullable();
            $table->double('account_balance')->default(0);
            $table->string('password');
            $table->timestamps();
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
