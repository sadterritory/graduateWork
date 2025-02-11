<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $url = isset($this->image) ? $this->image->url : null;
        return [
            'title' => $this->title,
            'content' => $this->content,
            'image_url' => $url,
            'date' => $this->created_at->diffForHumans()
        ];
    }
}
