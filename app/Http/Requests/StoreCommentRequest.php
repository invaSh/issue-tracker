<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'body' => 'required|string',
            'author_name' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'body.required' => 'The comment content cannot be empty.',
            'author_name.required' => 'The  author name cannot be empty.',
        ];
    }
}
