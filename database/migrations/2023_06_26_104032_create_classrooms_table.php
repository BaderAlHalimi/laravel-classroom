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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->char('code', 10)->unique();
            $table->string('section')->nullable();
            $table->string('subject')->nullable();
            $table->string('room')->nullable();
            $table->string('cover_image_path')->nullable(); // to save the path of this file on the project files
            // $table->binary('cover_image_path'); //to save this file as a file in the database
            $table->string('theme')->nullable();
            $table->foreignId('user_id')
                ->constrained('users', 'id')
                ->cascadeOnDelete(); //OnDelete('cascade');
            $table->enum('status', ['active', 'archived'])->default('active');
            $table->timestamps();//created_at + Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
