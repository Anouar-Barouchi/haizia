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
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('is_checked_in');
            $table->string('password')->nullable()->after('email');
            $table->string('competition_status')->default('pending_arrival')->after('status');
            $table->timestamp('competition_started_at')->nullable()->after('competition_status');
            $table->timestamp('competition_submitted_at')->nullable()->after('competition_started_at');
            $table->string('camera_brand')->nullable()->after('competition_submitted_at');
            $table->string('camera_model')->nullable()->after('camera_brand');
            $table->string('camera_lenses')->nullable()->after('camera_model');
            $table->json('competition_submissions')->nullable()->after('camera_lenses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->boolean('is_checked_in')->default(false);
            $table->dropColumn([
                'password',
                'competition_status',
                'competition_started_at',
                'competition_submitted_at',
                'camera_brand',
                'camera_model',
                'camera_lenses',
                'competition_submissions'
            ]);
        });
    }
};
