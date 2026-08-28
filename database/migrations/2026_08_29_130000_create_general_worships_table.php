<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('general_worships', function (Blueprint $table) {
            $table->id();
            $table->enum('session', ['morning', 'afternoon'])->default('morning');
            $table->string('time')->nullable();
            $table->string('location')->nullable();
            $table->string('preacher')->nullable();
            $table->string('liturgist')->nullable();
            $table->string('coordinator')->nullable();
            $table->string('prayer_leader')->nullable();
            $table->string('announcement')->nullable();
            $table->string('offering')->nullable();
            $table->string('collector_1')->nullable();
            $table->string('collector_2')->nullable();
            $table->string('greeter_1')->nullable();
            $table->string('greeter_2')->nullable();
            $table->string('organist_1')->nullable();
            $table->string('organist_2')->nullable();
            $table->string('song_leader_1')->nullable();
            $table->string('song_leader_2')->nullable();
            $table->string('worship_leader')->nullable();
            $table->string('multimedia')->nullable();
            $table->string('praise_offering')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('general_worships');
    }
};
