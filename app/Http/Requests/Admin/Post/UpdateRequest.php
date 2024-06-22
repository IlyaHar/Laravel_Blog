<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3'],
            'content' => ['required', 'string', 'min:15'],
            'preview_image' => ['nullable', 'image'],
            'main_image' => ['nullable', 'image'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'tags_ids' => ['nullable', 'array'],
            'tags_ids.*' => ['nullable', 'exists:tags,id'],
        ];
    }
}
