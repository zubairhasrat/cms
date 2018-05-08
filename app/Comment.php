<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=[
        'comment_author',
        'comment_author_email',
        'comment_content',
        'comment_status',
        'comment_post_id'
    ];
    public function posts()
    {
      return $this->belongsTo('App\Post');
    }
}
