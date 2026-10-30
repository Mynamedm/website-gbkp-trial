<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reflections', function (Blueprint $table) {
            $table->string('type')->default('renungan')->after('slug');
            $table->index(['type', 'status', 'date']);
        });
    }

    public function down(): void
    {
        Schema::table('reflections', function (Blueprint $table) {
            $table->dropIndex(['type', 'status', 'date']);
            $table->dropColumn('type');
        });
    }
};
