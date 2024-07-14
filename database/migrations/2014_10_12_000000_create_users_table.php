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
            $table->string('department');
            $table->string('tender');
            $table->string('newsEvent');
            $table->string('about');
            $table->string('career');
            $table->string('document');
            $table->string('disaster');
            $table->string('contact');
            $table->string('corporate');
            $table->string('calendar');
            $table->string('dailyGeneration');
            $table->string('admin');
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
            'department' => 'IT Cell',
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
