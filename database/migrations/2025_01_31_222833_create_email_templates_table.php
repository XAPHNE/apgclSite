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
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->longText('email_body');
            $table->longText('signature');
            $table->string('attachment')->nullable();
            $table->boolean('is_birthday');
            $table->boolean('is_joining_aniversery');
            $table->boolean('is_retirement');
            $table->boolean('is_holiday');
            $table->foreignId('event_id')->nullable()->constrained('events')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('email_templates');
    }
};
