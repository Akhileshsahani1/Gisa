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
        Schema::create('renewal_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('renewal_id')->nullable();
            $table->foreign('renewal_id')->references('id')->on('renewal_policies')->onUpdate('cascade')->onDelete('cascade');
            $table->text('comment');
            $table->unsignedBigInteger('comment_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renewal_comments');
    }
};
