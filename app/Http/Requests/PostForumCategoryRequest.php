<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostForumCategoryRequest extends FormRequest
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
            'title' => 'required',
        ];
    }

    /**
     * Prepare for validation.
     */
    public function prepareForValidation()
    {
        $input = array_map('trim', $this->all());

        $input['slug'] = str_slug($this->title);
        $input['description'] = clean($this->description);

        $this->replace($input);
    }
}
