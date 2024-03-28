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
        Schema::table('gpxes', function (Blueprint $table) {
            $table->decimal('latstart', 8, 6)->nullable();
            $table->decimal('lonstart', 9, 6)->nullable();
            $table->decimal('latend', 8, 6)->nullable();
            $table->decimal('lonend', 9, 6)->nullable();
            $table->decimal('latelemax', 8, 6)->nullable();
            $table->decimal('lonelemax', 9, 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gpxes', function (Blueprint $table) {
            //
        });
    }
};
