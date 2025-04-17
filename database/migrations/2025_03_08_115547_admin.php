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
        Schema::create('admin', function(Blueprint $table){
            $table->id();
            $table->string('username')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('admin_type',[1, 2, 3])->comment('1 admin, 2 subadmin, 3 manager');
            $table->enum('admin_status', [1, 0])->default(1)->comment('1 active, 0 deactive');
            $table->timestamps();
        });

        Schema::create('smtp_settings', function(Blueprint $table){
            $table->id();
            $table->string('host')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->integer('port')->nullable();
            $table->string('protocol')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
        Schema::dropIfExists('smtp_settings');
    }
};
