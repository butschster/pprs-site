<?php

namespace App\Http\Requests\Pages;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class RebuildTreeRequest extends FormRequest
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
            'pages' => 'required|array',
        ];
    }

    public function persist()
    {
        Page::unguarded(function () {
            Page::rebuildTree($this->getTree());
        });
    }

    protected function getTree(): array
    {
        return $this->cleanTree($this->pages);
    }

    /**
     * @param $pages
     * @return array
     */
    protected function cleanTree($pages): array
    {
        foreach ($pages as &$page) {
            $page = Arr::only($page, ['id', '_lft', '_rgt', 'parent_id', 'children']);

            if (!empty($page['children'])) {
                $page['children'] = $this->cleanTree($page['children']);
            }
        }

        return $pages;
    }
}
