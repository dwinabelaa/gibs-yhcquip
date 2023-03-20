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
        Schema::table('galleries', function (Blueprint $table) {
            $table->tinyInteger('is_published')->default(0)->after('description');
        });

        Schema::table('careers', function (Blueprint $table) {
            $table->tinyInteger('is_published')->default(0)->after('description');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->tinyInteger('is_published')->default(0)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['is_published']);
        });
    }
};
