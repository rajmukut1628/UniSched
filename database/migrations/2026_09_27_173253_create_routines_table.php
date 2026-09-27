<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_assignment_id')
                ->constrained('course_assignments')
                ->cascadeOnDelete();

            $table->foreignId('section_id')
                ->constrained('sections')
                ->cascadeOnDelete();

            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->cascadeOnDelete();

            $table->foreignId('room_id')
                ->constrained('rooms')
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

            $table->enum('status', [
                'draft',
                'published'
            ])->default('draft');

            $table->timestamps();

            // Same room cannot have two classes
            // at the same day and time.
            $table->unique(
                ['room_id', 'day', 'time_slot_id'],
                'routine_room_conflict_unique'
            );

            // Same teacher cannot take two classes
            // at the same day and time.
            $table->unique(
                ['teacher_id', 'day', 'time_slot_id'],
                'routine_teacher_conflict_unique'
            );

            // Same section cannot have two classes
            // at the same day and time.
            $table->unique(
                ['section_id', 'day', 'time_slot_id'],
                'routine_section_conflict_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routines');
    }
};