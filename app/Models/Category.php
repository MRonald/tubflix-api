<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'name',
    ];

    protected $hidden = [
        'active',
        'updated_at',
        'pivot',
    ];

    public function getVideos()
    {
        return $this->belongsToMany(Video::class, 'category_videos');
    }
}
