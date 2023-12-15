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
        Schema::create('cat_topographies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::table('gpxes', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\CatTopography::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_topographies');
        Schema::table('gpxes', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\CatTopography::class);
        });
    }
};
