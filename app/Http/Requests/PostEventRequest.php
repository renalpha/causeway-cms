<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostEventRequest
 * @package App\Http\Requests
 */
class PostEventRequest extends FormRequest
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
            'start_datetime' => ['required', 'date', request()->start_datetime ? 'before:end_datetime' : ''],
            'end_datetime' => ['date', request()->start_datetime ? 'after:start_datetime' : ''],
        ];
    }

    /**
     * Prepare for validation.
     */
    public function prepareForValidation()
    {
        $input = array_map('trim', $this->all());

        $input['start_datetime'] = Carbon::parse($this->start_datetime);
        $input['end_datetime'] = Carbon::parse($this->end_datetime);
        $input['slug'] = str_slug($this->title);
        $input['user_id'] = auth()->user()->id;

        $this->replace($input);
    }
}
