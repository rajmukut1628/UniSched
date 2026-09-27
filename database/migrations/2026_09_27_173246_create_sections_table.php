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
    Schema::create('sections', function (Blueprint $table) {
        $table->id();

        $table->foreignId('semester_id')
            ->constrained('semesters')
            ->cascadeOnDelete();

        $table->string('name'); // A, B, C etc.
        $table->string('code'); // 8A, 8B, 8C etc.
        $table->boolean('is_active')->default(true);

        $table->timestamps();

        $table->unique(['semester_id', 'code']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
