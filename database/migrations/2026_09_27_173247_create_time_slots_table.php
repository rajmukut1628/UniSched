<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();

            $table->time('start_time');
            $table->time('end_time');

            $table->unsignedInteger('sort_order')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique(['start_time', 'end_time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};