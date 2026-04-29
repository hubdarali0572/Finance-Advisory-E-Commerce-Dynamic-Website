<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'title',
        'slug',
        'short_description',
        'content',
        'file_path',
        'gallery_images',
        'video_url',
        'audio_url',
        'status',
        'published_at',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'views',
        'likes',
        'shares',
        'reading_time',
        'comment_count',
        'tags',
        'related_blogs',
        'featured',
        'is_premium',
        'priority',
        'comments_enabled',
        'blog_date'
    ];

    /**
     * Relationship: A User belongs to a Category
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A Blog belongs to a Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
}
