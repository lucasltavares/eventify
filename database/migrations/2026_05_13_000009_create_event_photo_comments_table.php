<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_photo_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_photo_id')->constrained()->cascadeOnDelete();
            $table->string('author_name');
            $table->text('comment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_photo_comments');
    }
};
