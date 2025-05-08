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
        Schema::create('support_members_admin', function(Blueprint $table){
            $table->id();
            $table->string('member_id');
            $table->string('urgency_lable');
            $table->string('support_subject');
            $table->text('support_message');
            $table->string('support_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_members_admin');
    }
};
