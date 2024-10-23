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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('location');
            $table->integer('priority');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->string('downloadLink')->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
