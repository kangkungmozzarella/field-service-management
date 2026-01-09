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
   Schema::create('tickets', function (Blueprint $table) {
    $table->id();
    $table->foreignId('work_order_id')->constrained();
    $table->string('ticket_code')->unique();
    $table->string('status')->index(); // OPEN, CLOSED
    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
