<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'Full Name'=>$this->name,
            'E-mail'=>$this->email,
            'Lessons'=>LessonResource::collection($this->lessons),
           ];
    }
}