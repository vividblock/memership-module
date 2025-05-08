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
        Schema::create('notification_info', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('member_id'); 
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->text('notification_message')->nullable();
            $table->string('notification_link')->nullable();
            $table->boolean('notification_status')->default(false);
            $table->string('notification_reason')->nullable();
            $table->timestamps();
        });

        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_info');
    }
};
