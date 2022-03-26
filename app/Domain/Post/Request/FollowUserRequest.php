<?php

namespace App\Domain\Post\Request;

use App\Exceptions\UnprocessableEntityException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class FollowUserRequest extends FormRequest
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
            'followerId' => 'required|exists:users,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $data = [
            'module' => 'post',
            'errorType' => 'POST_PARAMETER_INVALID',
            'data' => [
                'errors' => $validator->errors(),
            ],
        ];
        throw new UnprocessableEntityException($data);
    }
}
