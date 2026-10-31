<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->index('category_id');

            $table->string('status')->default('draft')->index()->after('category_id');
            $table->timestamp('scheduled_at')->nullable()->after('published_at');

            $table->softDeletes();

            $table->dropIndex(['category']);
            $table->dropColumn('category');

            $table->index(['status', 'published_at']);
            $table->index(['category_id', 'status', 'published_at']);
            $table->index(['slug', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropIndex(['status', 'published_at']);
            $table->dropIndex(['category_id', 'status', 'published_at']);
            $table->dropIndex(['slug', 'status']);
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'status', 'scheduled_at']);
            $table->string('category')->nullable()->after('author_name');
            $table->index('category');
        });
    }
};
