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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_title')->nullable();
            $table->integer('course_type');
            $table->string('institution');
            $table->string('location');
            $table->string('subject');
            $table->json('languages');
            $table->string('language_level_german')->nullable();
            $table->string('language_level_english')->nullable();
            $table->string('costs')->nullable();
            $table->string('duration');
            $table->string('beginning');
            $table->json('dates');
            $table->string('programme_url');
            $table->string('image_url')->nullable();
            $table->boolean('is_online');
            $table->text('application_deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
