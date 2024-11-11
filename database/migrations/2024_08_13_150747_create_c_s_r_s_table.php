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
        Schema::create('c_s_r_s', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('description');
            $table->String('downloadLink');
            $table->boolean('visibility');
            $table->boolean('news_n_events');
            $table->boolean('new_badge');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_s_r_s');
    }
};
