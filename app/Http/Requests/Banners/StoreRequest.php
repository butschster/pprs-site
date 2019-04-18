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
            'content' => 'required',
            'image_uuid' => ['nullable', Rule::exists('images', 'uuid')],
        ];
    }

    /**
     * @return Banner
     */
    public function persist(): Banner
    {
        return Banner::create($this->validated());
    }
}
