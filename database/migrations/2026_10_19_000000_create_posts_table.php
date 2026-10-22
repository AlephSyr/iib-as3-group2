<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('author_name');
            $table->string('category');
            $table->text('excerpt');
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index('published_at');
            $table->index('slug');
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
