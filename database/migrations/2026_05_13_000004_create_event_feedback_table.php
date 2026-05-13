<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('rsvp_id')->constrained()->onDelete('cascade');
            $table->string('token')->unique();
            $table->string('recipient_name');
            $table->string('recipient_email')->nullable();
            $table->string('recipient_phone')->nullable();
            $table->timestamp('invitation_sent_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->unsignedTinyInteger('overall_rating')->nullable();
            $table->unsignedTinyInteger('organization_rating')->nullable();
            $table->unsignedTinyInteger('experience_rating')->nullable();
            $table->text('highlight')->nullable();
            $table->text('improvement')->nullable();
            $table->boolean('would_recommend')->nullable();
            $table->timestamps();

            $table->unique('rsvp_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_feedback');
    }
};
