<?php

namespace App\Http\Requests\Api\v1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserDeleteRequest extends AdministratorRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return parent::authorize() && ! $this->route('user')->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
