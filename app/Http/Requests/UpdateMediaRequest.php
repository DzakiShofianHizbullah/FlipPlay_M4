<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $media = $this->route('media');

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($media),
            ],
            'type' => 'required|in:Movie,Series',
            'genre' => 'required|string|max:100',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer|min:1900|max:2100',
        ];
    }
}
