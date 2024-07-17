<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(Request $request): array
    {
        return [
            'surname' => ['nullable', 'string', 'max:40'],
            'name' => ['required', 'string'],
            'patronymic' => ['nullable', 'string', 'max:40'],
            'birthday' => ['nullable', 'date'],
            'nickname' => ['required', 'integer', 'digits_between:1,3', Rule::unique('users')],
            'email' => ['required', 'string', Rule::unique('users')],
            'password' => ['string'],
            'note' => ['nullable', 'string', 'max:500'],
            'department_id' => ['nullable'],
            'position_id' => ['nullable'],
            'role_id' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'nickname' => 'такой уже есть',
            'email' => 'такой логин уже есть',
        ];
    }
}
