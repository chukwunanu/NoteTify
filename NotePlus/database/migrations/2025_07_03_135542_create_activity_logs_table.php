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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('action_type'); // e.g., 'note_created', 'note_updated', 'note_deleted'
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('note_id')->constrained('notes')->onDelete('cascade');
            $table->text('description')->nullable(); // Optional description of the activity
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
