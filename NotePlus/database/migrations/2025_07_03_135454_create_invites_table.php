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
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->string('member_name'); // Name of the invited member
            $table->string('title'); // Title of the invite (e.g., Web Developer, etc.)
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('code')->unique(); // Unique invite code
            $table->timestamp('expires_at')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invites');
    }
};
