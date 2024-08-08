<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->boolean('tender')->default(0)->change();
            $table->boolean('newsEvent')->default(0)->change();
            $table->boolean('about')->default(0)->change();
            $table->boolean('career')->default(0)->change();
            $table->boolean('document')->default(0)->change();
            $table->boolean('disaster')->default(0)->change();
            $table->boolean('contact')->default(0)->change();
            $table->boolean('corporate')->default(0)->change();
            $table->boolean('calendar')->default(0)->change();
            $table->boolean('dailyGeneration')->default(0)->change();
            $table->boolean('admin')->default(0)->change();
            $table->rememberToken();
            $table->string('two_factor_code')->nullable();
            $table->dateTime('two_factor_expires_at')->nullable();
            $table->timestamps();
        });

        //  Insert admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@apgcl.org',
            'password' => bcrypt('secret'),
            'tender' => 0,
            'newsEvent' => 0,
            'about' => 0,
            'career' => 0,
            'document' => 0,
            'disaster' => 0,
            'contact' => 0,
            'corporate' => 0,
            'calendar' => 0,
            'dailyGeneration' => 0,
            'admin' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
