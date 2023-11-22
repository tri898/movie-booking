<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'status' => 'boolean',
            'roles' => 'required|array|exists:roles,name',
            'name' => 'required|min:2|max:100'
        ];
        if (request()->routeIs('admin.user-manager.store')) {
            $rules['email'] = 'required|email|max:100|unique:admins';
            $rules['password'] = [
                'required', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                'confirmed'
            ];

        } elseif (request()->routeIs('admin.user-manager.update')) {
            $rules['password'] = ['nullable',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                'confirmed'
            ];
        }

        return $rules;
    }
}
