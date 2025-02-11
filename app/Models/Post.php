<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $with = ['image'];
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function image()
    {
        return $this->hasOne(PostImage::class, 'post_id', 'id')
            ->whereNotNull('status');
    }
}
