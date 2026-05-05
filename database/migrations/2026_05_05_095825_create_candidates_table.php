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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('birth_info');
            $table->string('address');
            $table->string('membership'); // مؤسسة شبانية, جمعية, حر
            $table->string('membership_name')->nullable();
            $table->string('profile_pic')->nullable();
            $table->json('gallery')->nullable();
            $table->boolean('has_experience')->default(false);
            $table->text('experience_list')->nullable();
            $table->boolean('has_awards')->default(false);
            $table->text('awards_list')->nullable();
            $table->string('status')->default('pending'); // pending, accepted, rejected, waitlist
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
