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
        Schema::create('disaster_management', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('fileName');
            $table->string('fileLink');
            $table->boolean('visibility')->default(false);
            $table->boolean('news_n_events')->default(false);
            $table->boolean('new_badge')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disaster_management');
    }
};
