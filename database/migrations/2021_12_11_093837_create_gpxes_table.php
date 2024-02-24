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
            $table->date('date');
            $table->integer('distance');
            $table->integer('eleAsc');
            $table->integer('eleDsc');
            $table->integer('distEff');
            $table->integer('eleStart');
            $table->integer('eleMax');
            $table->time('duration');
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
