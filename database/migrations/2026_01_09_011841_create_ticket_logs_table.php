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
        Schema::create('ticket_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('ticket_id')->constrained();
    $table->string('action')->index(); // CREATED, UPDATED, CLOSED, etc
    $table->text('note')->nullable();
    $table->timestamp('created_at')->useCurrent();

    // untuk histori ticket
    $table->index(['ticket_id', 'created_at']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_logs');
    }
};
