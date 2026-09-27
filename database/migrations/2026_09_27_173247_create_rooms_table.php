<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->string('room_number')->unique(); // 401, 402, B003
            $table->string('room_name')->nullable();

            $table->enum('room_type', [
                'classroom',
                'computer_lab',
                'eee_lab',
                'physics_lab',
                'other'
            ])->default('classroom');

            $table->unsignedInteger('capacity')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};