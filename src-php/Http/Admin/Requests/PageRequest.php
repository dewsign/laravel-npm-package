<?php

namespace Maxfactor\CMS\Pages\Http\Admin\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'active' => 'nullable|boolean',
            'name' => 'required',
            'slug' => 'required|alpha_dash',
            'parent_id' => 'nullable|numeric|exists:pages,id',
            'h1' => 'nullable|string',
            'browser_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'priority' => 'nullable|numeric',
            'sort' => 'nullable|numeric',
            'featured_image' => 'nullable',
            'page_content' => 'nullable',
        ];
    }
}
