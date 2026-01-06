<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, remove any duplicate entries, keeping only the oldest one
        DB::statement('
            DELETE t1 FROM liked_items t1
            INNER JOIN liked_items t2 
            WHERE t1.id > t2.id 
            AND t1.user_id = t2.user_id 
            AND t1.listing_id = t2.listing_id
        ');

        // Then add the unique constraint
        Schema::table('liked_items', function (Blueprint $table) {
            $table->unique(['user_id', 'listing_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liked_items', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'listing_id']);
        });
    }
};
