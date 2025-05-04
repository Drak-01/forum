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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('groupPicture')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('createdAt')->useCurrent();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Clé étrangère pour le propiétaire du groupe lors de la création du groupe
            // $table->foreignId('quest_id')->nullable()->constrained('questions')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
