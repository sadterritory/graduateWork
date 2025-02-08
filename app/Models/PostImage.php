<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $path
 */
class PostImage extends Model
{
    protected $fillable = ['title', 'content', 'path'];

    public function getUrlAttribute(): string
    {
        return url("storage/{$this->path}");
    }
}
