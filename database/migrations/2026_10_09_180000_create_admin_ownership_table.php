<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_ownership', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->primary();
            $table->foreignId('owner_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });

        $email = strtolower(trim((string) config('app.owner_admin_email')));
        $ownerId = $email === '' ? null : DB::table('users')->whereRaw('LOWER(email) = ?', [$email])->value('id');

        DB::table('admin_ownership')->insert([
            'id' => 1,
            'owner_id' => $ownerId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_ownership');
    }
};
