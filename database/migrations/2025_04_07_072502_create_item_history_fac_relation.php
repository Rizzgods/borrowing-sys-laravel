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
        // Modify existing ItemHistory table to add fac_id column
        Schema::table('ItemHistory', function (Blueprint $table) {
            $table->unsignedBigInteger('fac_id')->nullable();
            
            // Add foreign key relationship
            $table->foreign('fac_id')->references('id')->on('Fac_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ItemHistory', function (Blueprint $table) {
            // Remove foreign key first
            $table->dropForeign(['fac_id']);
            
            // Then remove the column
            $table->dropColumn('fac_id');
        });
    }
};