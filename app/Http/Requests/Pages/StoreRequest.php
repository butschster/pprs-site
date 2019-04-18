<?php

namespace App\Http\Requests\Pages;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'color' => 'required|string',
            'parent_id' => ['nullable', Rule::exists('pages', 'id')],
            'banner_id' => ['nullable', Rule::exists('banners', 'id')],
            'slug' => ['nullable', 'min:3', Rule::unique('pages')],
            'text' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'section_title' => 'nullable|string',
            'section_subtitle' => 'nullable|string',
            'section_text' => 'nullable|string',
            'section_image_uuid' => ['nullable', Rule::exists('images', 'uuid')],
        ];
    }

    /**
     * @return Page
     */
    public function persist(): Page
    {
        $data = $this->validated();
        Arr::forget($data, 'parent_id');
        $page = Page::create($data);

        if (!empty($this->parent_id)) {
            Page::findOrFail($this->parent_id)->appendNode($page);
        }

        return $page;
    }
}