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
        Schema::create('board_of_directors', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('designation');
            $table->String('organisation');
            $table->String('downloadLink');
            $table->boolean('is_chairman');
            $table->boolean('is_md');
            $table->boolean('is_gov_rep');
            $table->boolean('is_indi_ditr');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('updated_by')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_of_directors');
    }
};
