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
        Schema::create('ues', function (Blueprint $table) {
           // $table->string('codeUE')->primary()->check("'codeUE' LIKE ");
           $table->string('codeUE')->primary();
           $table->string('codeEC');
            $table->string('Element_Constitutif');
            $table->integer('VHT');
            $table->integer('Coef');
            $table->integer('Credit'); 
            $table->timestamps();
        });
        DB::statement("ALTER TABLE ues ADD CONSTRAINT check_codeUE CHECK (codeUE LIKE 'INF%')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ues');
    }
};
