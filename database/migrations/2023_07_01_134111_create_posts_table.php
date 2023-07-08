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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content')->nullable();
            $table->enum('files', ['has', 'hasnot'])->default('hasnot');
            $table->enum('type', ['post', 'material','assignment'])->default('post');
            $table->foreignId('user_id')
                ->constrained('users', 'id')
                ->cascadeOnDelete(); //OnDelete('cascade');
            $table->foreignId('classroom_id')
                ->constrained('classrooms', 'id')
                ->cascadeOnDelete(); //OnDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
