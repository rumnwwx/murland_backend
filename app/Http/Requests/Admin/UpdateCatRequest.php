<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCatRequest extends ApiRequest
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
            'name' => 'nullable|string|min:3|max:255',
            'gender' => 'nullable|in:Кот,Кошка',
            'birth_date' => 'nullable|date_format:d.m.Y',
            'color' => 'nullable|string|min:3|max:255',
            'breed_id' => 'nullable|in:Абиссинская,Бурма|min:3|max:255',
            'status' => 'nullable|in:available,reserved,adopted',
            'photo_id' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
