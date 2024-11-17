<?php

namespace App\Http\Requests\ToDoItem;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateToDoItemRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'is_completed' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Task name is required.',
            'name.max' => 'Task name can\'t exceed 255 letters',
            'is_completed.required' => 'Task status is required.',
            'is_completed.boolean' => 'Task status must be boolean.',
        ];
    }
}
