<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->enum('type', ['umum', 'kategorial'])->nullable()->after('category_id');
        });

        // Backfill existing data: no category => umum, has category => kategorial
        DB::table('schedules')->whereNull('category_id')->whereNull('type')->update(['type' => 'umum']);
        DB::table('schedules')->whereNotNull('category_id')->whereNull('type')->update(['type' => 'kategorial']);
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
