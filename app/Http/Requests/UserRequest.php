<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->route('id')) {
            return [
                'name' => 'required|max:250',
                'email' => ['required', 'email', 'max:250', Rule::unique('users')->ignore($this->route('id'))],
                'role_id' => 'required',
                'password' => ['nullable','confirmed', Password::min(8)],
            ];
        } else {
            return [
                'name' => 'required|max:250',
                'email' => 'required|email|max:250',
                'role_id' => 'required',
            ];
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => __('The name is required'),
            'name.max' => __('The name can be max 250 chars'),
            'email.required' => __('The email is required'),
            'email.max' => __('The email can be max 250 chars'),
            'email.email' => __('The email must be a valid email address'),
            'role_id.required' => __('The role is required'),
            'password.confirmed' => __('Password does not mach the confirmed password'),
            'password.min' => __('The password is to short. Must be 8 chars or longer.'),
        ];
    }
}
