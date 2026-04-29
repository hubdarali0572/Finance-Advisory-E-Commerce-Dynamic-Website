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
        Schema::create('draft_posts', function (Blueprint $table) {
           $table->id();

            // Relations
            $table->unsignedBigInteger('user_id');       // Author
            $table->unsignedBigInteger('category_id');   // Category
            $table->unsignedBigInteger('subcategory_id');   // Category

            // Main content
            $table->string('title');                      // Blog title
            $table->string('slug')->unique();             // SEO-friendly URL
            $table->text('short_description')->nullable(); // Summary or excerpt
            $table->longText('content');                  // Full blog content
           $table->date('blog_date');               

            // Media
           // Media paths
            $table->string('file_path')->nullable();   // video path
            $table->string('image_path')->nullable();  // image path
            $table->string('audio_path')->nullable();  // audio path
            $table->json('gallery_images')->nullable();   // Optional multiple images
            $table->string('video_url')->nullable();      // Optional video link
            $table->string('audio_url')->nullable();      // Optional audio link

            // Status & scheduling
            $table->enum('status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->timestamp('published_at')->nullable(); // Scheduled publication

            // SEO
            $table->text('seo_title')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();

            // Engagement & analytics
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('shares')->default(0);
            $table->integer('reading_time')->nullable();  // Estimated reading time in minutes
            $table->integer('comment_count')->default(0);

            // Categorization & tags
            $table->json('tags')->nullable();            // Tags as JSON array
            $table->json('related_blogs')->nullable();   // Related blogs IDs as JSON array

            // Timestamps
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draft_posts');
    }
};
