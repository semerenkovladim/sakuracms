<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'price' => $this->price,
            'short_description' => $this->short_description,
            'meta_tags' => $this->meta_tags,
            'meta_description' => $this->meta_description,
            'meta_title' => $this->meta_title,
            'category' => $this->category,
            'images' => FileResource::collection($this->images),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
