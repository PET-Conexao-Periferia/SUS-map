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
        Schema::table('locations_campaigns', function (Blueprint $table) {
            $table->renameColumn('campaigns_id', 'campaign_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations_campaigns', function (Blueprint $table) {
            $table->renameColumn('campaign_id', 'campaigns_id');
        });
    }
};
