<?php

namespace App\Http\Requests\Pages;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
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
            'title' => 'required|min:3',
            'color' => 'required',
            'parent_id' => ['nullable', Rule::exists('pages', 'id')],
            'slug' => ['nullable', 'min:3', Rule::unique('pages')->ignore($id)],
        ];
    }

    /**
     * @param Page $page
     */
    public function persist(Page $page)
    {
        $data = $this->validated();
        Arr::forget($data, 'parent_id');
        $page->update($data);

        if ($this->has('parent_id')) {
            Page::findOrFail($this->parent_id)->appendNode($page);
        }
    }
}
