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
        Schema::create('ticket_assignments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('ticket_id')->constrained();
    $table->foreignId('technician_id')->constrained();
    $table->timestamp('assigned_at')->useCurrent();

    // untuk JOIN & count teknisi
    $table->index(['ticket_id', 'technician_id']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_assignments');
    }
};
