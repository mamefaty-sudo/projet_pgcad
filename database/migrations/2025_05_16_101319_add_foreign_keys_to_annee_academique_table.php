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
        Schema::table('annee_academiques', function (Blueprint $table) {
            $table->foreign('date_morte_id')->references('id')->on('date_mortes');
            $table->foreign('date_extreme_id')->references('id')->on('date_extremes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('date_mortes', function (Blueprint $table) {
            //
        });
    }
};
