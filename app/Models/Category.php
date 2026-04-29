<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

    /**
     * Relationship: A Category has many Blogs
     */
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
