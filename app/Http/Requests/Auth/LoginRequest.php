<?php

namespace App\Http\Requests\Auth;

use App\Exceptions\UnprocessableEntityException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $data = [
            'module' => 'auth',
            'errorType' => 'AUTH_PARAMETER_ERROR',
            'data' => [
                'errors' => $validator->errors(),
            ],
        ];
        throw new UnprocessableEntityException($data);
    }
}
