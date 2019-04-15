<?php

namespace App\Http\Requests\Banners;

use App\Models\Banner;
use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
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
            'page_id' => ['required', Rule::exists('pages', 'id')],
            'content' => 'required',
            'image_uuid' => ['required', Rule::exists('images', 'uuid')],
        ];
    }

    /**
     * @return Banner
     */
    public function persist(): Banner
    {
        $page = Page::findOrFail($this->page_id)->banner()->associate(
            $banner = Banner::create($this->validated())
        );

        $page->save();

        return $banner;
    }
}
