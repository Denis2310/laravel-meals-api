<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
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
            'page' => 'nullable|numeric|min:1',
            'per_page' => 'nullable|numeric|min:1',
            'category' => ['nullable', 'regex: /^\s*(\d+|!null|null)?\s*$/i'],
            'tags' => ['nullable', 'regex: /^\s*\d+(\s*,\s*\d+\s*)*$/'],
            'with' => ['nullable', 'regex: /^(\s*,*\s*\w+\s*,*\s*)*$/'],
            'diff_time' => 'nullable|numeric|min:1',
            'lang' => 'exists:languages,locale',
        ];
    }

    /**
     * Validation error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category.regex' => "Category could be 'NULL', '!NULL', Integer number",
            'tags.regex' => 'Numbers must be separated by comma',
            'with.regex' => "List of words separated by comma. Available options: 'category','tags','ingredients'",
        ];
    }

    /**
     * Return response if validation fails
     *
     * @param  Validator $validator
     * @return Exception HttpResponseException Response with validation errors
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
