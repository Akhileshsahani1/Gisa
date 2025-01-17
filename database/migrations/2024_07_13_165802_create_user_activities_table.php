<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('type',
            [
            'login', 
            'logout', 
            'lead generated',
            'lead updated',
            'lead status changed', 
            'follow up added', 
            'follow up done', 
            'comment added', 
            'transaction added',
            'estimate generated',
            'estimate updated',
            'booking generated',
            'booking updated',            
            'customer added',
            'voucher generated',
            'voucher sent',
            'ticket added',
            'ticket updated',
            ])->nullable();
            $table->text('comment')->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activities');
    }
}
