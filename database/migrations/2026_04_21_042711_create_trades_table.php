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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('pair');
            $table->enum('direction', ['BUY', 'SELL']);
            $table->dateTime('trade_date');
            $table->enum('session', ['Asian', 'London', 'New York', 'Overlap']);
            $table->integer('duration_minutes')->nullable();
            $table->decimal('entry_price', 10, 4);
            $table->decimal('tp_price', 10, 4)->nullable();
            $table->decimal('sl_price', 10, 4)->nullable();
            $table->decimal('lot_size', 8, 2)->nullable();
            $table->decimal('pnl_amount', 10, 2);
            $table->decimal('risk_reward', 5, 2)->nullable();
            $table->tinyInteger('setup_quality')->nullable();
            $table->enum('emotion', ['Neutral', 'Confident', 'FOMO', 'Revenge', 'Anxious'])->nullable();
            $table->json('strategy_tags')->nullable();
            $table->boolean('mistake_flag')->default(false);
            $table->text('emotion_notes')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
