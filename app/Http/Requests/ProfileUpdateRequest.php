<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'address' => ['required', 'string', 'max:255'],
            'typologies' => 'required|exists:typologies,id',

            'description' => 'nullable|string',
            'services' => 'nullable|string',
            'photo' => 'nullable|image:jpg, jpeg, png, svg, webp, pdf',
            'is_visible' => 'nullable|boolean',

            'delete_photo' => 'nullable|boolean',
        ];
    }
}
