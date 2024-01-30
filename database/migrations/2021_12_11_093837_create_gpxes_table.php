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
        Schema::create('gpxes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('date');
            $table->string('distance');
            $table->string('eleAsc');
            $table->string('eleDsc');
            $table->integer('distEff');
            $table->string('eleStart');
            $table->string('eleMax');
            $table->string('duration');
            $table->string('gpxpath')->nullable();
            $table->string('google')->nullable();
            $table->string('hut')->nullable();
            $table->longtext('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gpxes');
    }
};
