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
        Schema::create('ongoing_projects', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('location');
            $table->double('capacity');
            $table->String('link')->nullable();
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
        Schema::dropIfExists('ongoing_projects');
    }
};
