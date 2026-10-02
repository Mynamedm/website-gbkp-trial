<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Struktur Organisasi');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('periode')->nullable();
            $table->string('hero_image')->nullable();
            $table->timestamps();
        });

        Schema::create('organization_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('organization_members')->nullOnDelete();
            $table->string('slug')->unique();
            $table->string('position');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['parent_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_members');
        Schema::dropIfExists('organization_settings');
    }
};
