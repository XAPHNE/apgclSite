<?php

use App\Models\FinancialYear;
use App\Models\TenderFile;
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
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('tender_no');
            $table->longText('description');
            $table->boolean('is_archived');
            $table->boolean('for_review')->default(false);
            $table->string('directory_name');
            $table->foreignIdFor(FinancialYear::class)->constrained()->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('tenders');
    }
};
