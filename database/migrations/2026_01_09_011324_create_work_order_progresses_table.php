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
        Schema::create('work_order_progresses', function (Blueprint $table) {
    $table->id();
    $table->foreignId('work_order_id')->constrained();

    $table->string('status')->index();
    $table->text('note')->nullable();
    $table->timestamp('created_at')->useCurrent();

    // untuk query status terakhir
    $table->index(['work_order_id', 'created_at']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_order_progresses');
    }
};
