<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('event_type'); // hackathon, festival, workshop, masterclass
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->foreignId('venue_id')->constrained();
            $table->foreignId('hall_id')->constrained();
            $table->foreignId('category_id')->constrained('event_categories');
            $table->boolean('is_paid')->default(false);
            $table->decimal('price', 10, 2)->nullable();
            $table->string('status')->default('published'); // draft, published, completed
            $table->string('image')->nullable();
            $table->integer('max_participants')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
