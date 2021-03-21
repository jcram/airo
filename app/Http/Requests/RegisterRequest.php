<?php

namespace App\Http\Requests;

use App\Http\Enums\Currency;
use App\Rules\AgeList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'between:2,50'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
