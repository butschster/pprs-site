<?php

namespace App\Http\Requests\Banners;

use App\Models\Banner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'content' => 'nullable',
            'image_uuid' => ['nullable', Rule::exists('images', 'uuid')],
        ];
    }

    /**
     * @param Banner $banner
     */
    public function persist(Banner $banner)
    {
        $banner->update($this->validated());
    }
}
