<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'color' => $this->color,
            'meta_title' => $this->meta_title,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'banner_id' => $this->banner_id,

            'has_section_image' => $this->has_section_image,
            'section_image_uuid' => $this->section_image_uuid,
            'section_image_url' => $this->section_image_url,
            'section_title' => $this->section_title,
            'section_text' => $this->section_text,
            'is_article' => $this->isArticle(),
            'text' => $this->text,
        ];
    }
}
