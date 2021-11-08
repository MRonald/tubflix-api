<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'title',
        'description',
        'url_featured_image',
        'url_thumbnail_image',
        'url_video',
    ];

    protected $hidden = [
        'active',
        'updated_at',
        'pivot',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_videos');
    }
}
