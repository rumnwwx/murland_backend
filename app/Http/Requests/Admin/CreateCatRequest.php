<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateCatRequest extends ApiRequest
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
            'name' => 'required|string|min:3|max:255',
            'gender' => 'required|in:Кот,Кошка',
            'birth_date' => 'required|date_format:d.m.Y',
            'color' => 'required|string|min:3|max:255',
            'breed' => 'required|in:Абиссинская,Бурма|min:3|max:255',
            'status' => 'required|in:available,reserved,adopted',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

    }
}
