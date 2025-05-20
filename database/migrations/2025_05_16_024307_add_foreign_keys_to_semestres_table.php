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
        Schema::table('semestres', function (Blueprint $table) {
            $table->string('codeUE');
            $table->foreign('codeUE')->references('codeUE')->on('ues')->onDelete('cascade');
   
            //$table->foreign('niveau_id')->references('id')->on('niveaux');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('semestres', function (Blueprint $table) {
            //
        });
    }
};
