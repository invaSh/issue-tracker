<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:open,in_progress,closed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date|after_or_equal:today',
            'project_id' => 'required|exists:projects,id',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Project title cannot be empty!',
            'description.required' => 'Description cannot be empty!',
            'status.required' => 'status cannot be empty!',
            'due_date.required' => 'Due Date date cannot be empty!',
            'project_id.required' => 'Project cannot be empty!',
        ];
    }
}
