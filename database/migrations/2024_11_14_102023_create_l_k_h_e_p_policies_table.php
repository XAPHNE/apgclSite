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
        Schema::create('l_k_h_e_p_policies', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('description')->nullable();
            $table->String('downloadLink');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_k_h_e_p_policies');
    }
};