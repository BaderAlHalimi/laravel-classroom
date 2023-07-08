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
        Schema::create('subfiles', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->enum('type', ['file', 'url'])->default('file');
            $table->foreignId('submet_id')
                ->constrained('submets', 'id')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subfiles');
    }
};
