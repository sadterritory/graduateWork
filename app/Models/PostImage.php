<?php

namespace App\Models;

use App\Http\Resources\PostImage\PostImageResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $path
 */
class PostImage extends Model
{
    protected $fillable = ['path','status','post_id','user_id'];

    public function getUrlAttribute(): string
    {
        return url("storage/{$this->path}");
    }

    public static function clearStorage(){
        $images = PostImage::where('user_id', auth()->id())->whereNull('status')->get();
        foreach ($images as $image){
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }
    }
}
