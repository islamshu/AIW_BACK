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
        Schema::table('jobs_site', function (Blueprint $table) {
            $table->foreignId('job_group_id')
                ->nullable()
                ->after('id')
                ->constrained('job_groups')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs_site', function (Blueprint $table) {
            $table->dropConstrainedForeignId('job_group_id');
        });
    }
};
