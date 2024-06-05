<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'sub_title_1', 'content_1', 'thumb_1', 'sub_title_2', 'content_2', 'thumb_2',
        'sub_title_3', 'content_3', 'thumb_3', 'category_post_id', 'link', 'video', 'comment_id', 'status',
    ];

    public function category_post()
    {
        return $this->belongsTo(CategoryPost::class, 'category_post_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
