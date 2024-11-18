<?php

use App\Models\Tender;
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
        Schema::create('tender_files', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tender::class)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('name');
            $table->string('downloadLink');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tender_files');
    }
};
