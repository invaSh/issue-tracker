<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachTagRequest extends FormRequest
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
            'tag_id' => 'required|exists:tags,id',
        ];
    }
    public function messages(): array
    {
        return [
            'tag_id.required' => 'The tag cannot be empty!',
            'tag_id.exists' => 'The selected tag does not exist',
        ];
    }
}
