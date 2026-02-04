<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('habit_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('date');
            $table->string('status'); // done / skipped / unknown
            $table->timestamp('done_at')->nullable();
            $table->string('source')->default('manual');// manual / reminder / ai
            $table->timestamps();
            $table->unique(['habit_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
