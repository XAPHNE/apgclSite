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
        Schema::create('annual_statements', function (Blueprint $table) {
            $table->id();
            $table->String('description');
            $table->String('downloadLink');
            $table->boolean('visibility')->default(false);
            $table->boolean('news_n_events')->default(false);
            $table->boolean('new_badge')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_statements');
    }
};
