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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');

            // Basic info
            $table->string('name');
            $table->string('title');
            $table->longText('description')->nullable();

            // Media paths
            $table->string('file_path')->nullable();   // video path
            $table->string('image_path')->nullable();  // image path
            $table->string('audio_path')->nullable();  // audio path

            // Meta & status
            $table->json('tags')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            // SEO fields
            $table->text('seo_title')->nullable();
            $table->longText('seo_keywords')->nullable();
            $table->longText('seo_description')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
