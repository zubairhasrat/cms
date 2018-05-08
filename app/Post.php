<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
class Post extends Model
{
    protected $fillable = [
        'post_title',
        'post_category',
        'post_author',
        'post_status',
        'post_image',
        'post_tag',
        'post_content'
    ];
    public function comments()
    {
      return $this->hasMany('App\Comment');
    }
}
