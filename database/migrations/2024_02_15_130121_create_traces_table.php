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
        Schema::create('traces', function (Blueprint $table) {
            $table->id();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('ele')->nullable();
            $table->string('dis')->nullable();
            $table->string('tim')->nullable();
            $table->string('sid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traces');
    }
};
