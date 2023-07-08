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
        Schema::create('submets', function (Blueprint $table) {
            $table->id();
            $table->double('grade')->nullable();
            $table->foreignId('post_id')
                ->constrained('posts', 'id')
                ->cascadeOnDelete(); //OnDelete('cascade');
            $table->foreignId('user_id') // user Id that make this submition
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submets');
    }
};
