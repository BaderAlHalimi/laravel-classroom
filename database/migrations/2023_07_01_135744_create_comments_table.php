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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->enum('type',['public','private'])->default('public');
            $table->foreignId('user_id') // user Id that write this comment
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->foreignId('post_id')
                ->constrained('posts', 'id')
                ->cascadeOnDelete(); //OnDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
