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
            $table->decimal('lat', 8, 6);
            $table->decimal('lon', 9, 6);
            $table->float('ele', 5, 1);
            $table->float('dis', 3, 1)->nullable();
            $table->integer('sid')->index('sid');
            $table->timestamp('tim')->nullable();
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
