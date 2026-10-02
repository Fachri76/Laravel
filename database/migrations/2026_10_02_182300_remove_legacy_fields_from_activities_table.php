<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('activities', 'activity_date')) {
            Schema::table('activities', function (Blueprint $table) {
                $table->dropColumn('activity_date');
            });
        }

        if (Schema::hasColumn('activities', 'category')) {
            Schema::table('activities', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->date('activity_date')->nullable();
            $table->string('category')->nullable();
        });
    }
};