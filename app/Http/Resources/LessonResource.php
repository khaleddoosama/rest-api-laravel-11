<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'author' => $this->user->name,
                'title' => $this->title,
                'content' => $this->body,
                'tags' => $this->tags->map(function ($tag) // solve problem by map function
                {
                    return
                        [
                            'tag' => $tag->name,
                        ];
                }),
                // 'Tags'=>TagResource::collection($this->tags) ->will give Time execution Error
            ];
    }
}
