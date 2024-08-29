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
        Schema::create('renewal_contact_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('renewal_id')->nullable();
            $table->foreign('renewal_id')->references('id')->on('renewal_policies')->onDelete('cascade');
            $table->string('contacted_via')->nullable();
            $table->string('caller_name')->nullable();
            $table->string('receiver_name')->nullable();
            $table->date('calling_date')->nullable();
            $table->time('calling_time')->nullable();
            $table->longText('subject')->nullable();
            $table->longText('comment')->nullable();
            $table->string('attachment_call_recording')->nullable();
            $table->date('email_sent_date')->nullable();
            $table->string('email_sender_id')->nullable();
            $table->string('email_receiver_id')->nullable();
            $table->longText('email_subject')->nullable();
            $table->longText('email_body')->nullable();
            $table->string('attachment_email')->nullable();
            $table->date('message_date')->nullable();
            $table->string('whats_app_from')->nullable();
            $table->string('whats_app_from_dialcode')->nullable();
            $table->string('whats_app_to')->nullable();
            $table->string('whats_app_to_dialcode')->nullable();
            $table->longText('whatsapp_message')->nullable();
            $table->string('attachment_whatsapp')->nullable();
            $table->string('who_meet')->nullable();
            $table->string('whom_meet')->nullable();
            $table->date('meeting_date')->nullable();
            $table->time('meeting_time')->nullable();
            $table->string('meeting_location')->nullable();
            $table->longText('meeting_discussion')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->time('follow_up_time')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->foreign('added_by')->references('id')->on('administrators')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renewal_contact_histories');
    }
};
