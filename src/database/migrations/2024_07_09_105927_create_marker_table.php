<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**7
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marker', function (Blueprint $table) {
            $table->biginterger('id')->primary();
            $table->
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marker');
    }
};
