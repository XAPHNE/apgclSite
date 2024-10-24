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
            $table->string('description');
            $table->string('downloadLink');
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
        Schema::dropIfExists('c_s_r_s');
    }
};
