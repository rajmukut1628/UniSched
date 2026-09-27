<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_availabilities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->cascadeOnDelete();

            $table->foreignId('time_slot_id')
                ->constrained('time_slots')
                ->cascadeOnDelete();

            $table->enum('day', [
                'Saturday',
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday'
            ]);

            $table->boolean('is_available')->default(true);

            $table->timestamps();

            // Same teacher + same day + same slot cannot be duplicated
            $table->unique(
                ['teacher_id', 'day', 'time_slot_id'],
                'teacher_day_slot_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_availabilities');
    }
};