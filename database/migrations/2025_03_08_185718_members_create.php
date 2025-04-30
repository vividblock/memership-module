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
        Schema::create('members',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('members_c3sc_id')->unique();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('password');
            $table->string('memebership_package')->nullable();
            $table->string('free_membership_individual')->nullable();
            $table->enum('user_status',[0,1])->default(0)->comment('0 deactivate, 1 activate');
            $table->string('contactnumber')->nullable();
            $table->enum('membership_type',[1,2,3,4])->comment('1 Non profit group or organization, 2 Non profit individuals, 3 security sector, 4 private sector');
            $table->datetime('membership_expiry')->nullable()->comment('Membership expiration date');
            $table->timestamps();
        });

        Schema::create('members_interest', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('member_id'); 
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('your_activity')->nullable();
            $table->string('other_activity')->nullable();
            $table->string('special_interest')->nullable();
            $table->text('short_description')->nullable();
            $table->timestamps();
        });

        Schema::create('network_surveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id'); 
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('networks')->nullable();
            $table->string('network_interst')->nullable();
            $table->string('informal_discussion')->nullable();
            $table->string('how_to_use_this')->nullable();
            $table->string('how_u_use_this_details_media')->nullable();
            $table->date('member_signed_date')->nullable();
            $table->string('member_signed')->nullable();
            $table->timestamps();
        });

        Schema::create('temporary_members_validation', function (Blueprint $table){
            $table->id();
            $table->string('members_email')->nullable();
            $table->string('otp')->nullable();
            $table->enum('email_validation_status', [0, 1])->default(0)->comment('0 - not valid, 1 valid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
        Schema::dropIfExists('members_interest');
        Schema::dropIfExists('network_surveys');
        Schema::dropIfExists('temporary_members_validation');
    }
};
