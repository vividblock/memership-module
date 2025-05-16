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
        Schema::create('organisation', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('member_id'); 
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('organisation_name');
            $table->string('organisation_email');
            $table->string('correspondence_address');
            $table->string('city');
            $table->string('postcode');
            $table->string('country')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('social_handle')->nullable();
            $table->string('website')->nullable();
            $table->string('organization_details')->nullable();
            $table->text('organisation_request_descripiton')->nullable();
            $table->timestamps();
        });

        Schema::create('organisation_details', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('org_id'); 
            $table->foreign('org_id')->references('id')->on('organisation')->onDelete('cascade');
            $table->string('org_description')->nullable();
            $table->string('organisation_area')->nullable();
            $table->string('organisation_part_of')->nullable();
            $table->string('umbrella_body_details')->nullable();
            $table->string('quality_marks')->nullable();
            $table->date('date_accreditation_awarded')->nullable();
            $table->date('date_accreditation_reviewed')->nullable();
            $table->string('annual_turnover')->nullable();
            $table->string('currently_employ')->nullable();
            $table->string('volunteers_number')->nullable();
            $table->string('registered_on')->nullable();
            $table->string('support_to_recruit_volunteers')->nullable();
            $table->string('collaboration_area_1')->nullable();
            $table->string('collaboration_area_2')->nullable();
            $table->string('collaboration_area_3')->nullable();
            $table->timestamps();
        });

        Schema::create('organisation_local_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id'); 
            $table->foreign('org_id')->references('id')->on('organisation')->onDelete('cascade');
            $table->string('name_of_group')->nullable();
            $table->string('frequency_of_group_meetings')->nullable();
            $table->string('activity_taking_place')->nullable();
            $table->json('type_of_activities')->nullable(); // stores multiple selected options
            $table->string('type_of_activities_other')->nullable();
            $table->text('response_to_any_additional_information')->nullable();
            $table->string('receive_more_information_from_c3sc')->nullable(); // Yes/No
            $table->string('promotion_on_dewis_cymru_website')->nullable();   // Yes/No
            $table->string('know_more_dewis_cymru')->nullable();              // Yes/No
            $table->string('attend_events')->nullable();                      // Yes/No
            $table->text('gdpr')->nullable(); // consent message
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisation_local_activities');
        Schema::dropIfExists('organisation_details');
        Schema::dropIfExists('organisation');
    }
};
