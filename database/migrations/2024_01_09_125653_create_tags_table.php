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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('gpx_tag', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignIdFor(\App\Models\Gpx::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Tag::class)->nullable()->constrained()->cascadeOnDelete();
            $table->primary(['gpx_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('tags');
    }
};
