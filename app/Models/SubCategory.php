<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'category_id',
        'user_id',
        'name',
        'description',
        'file_path',
        'image_path',
        'audio_path',
        'tags',
        'status',
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

   

    /**
     * Relationship: SubCategory belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

      /**
     * Relationship: SubCategory belongs to Category
     */

     public function category()
    {
        return $this->belongsTo(Category::class);
    }

     /**
     * Relationship: SubCategory hasmany blogs
     */

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
