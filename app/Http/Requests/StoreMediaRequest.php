<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:media,title',
            'type' => 'required|in:Movie,Series',
            'genre' => 'required|string|max:100',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer|min:1900|max:2100',
        ];
    }
}