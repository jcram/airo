<?php

namespace App\Http\Requests;

use App\Http\Enums\Currency;
use App\Rules\AgeList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuotationRequest extends FormRequest
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
            'age' => ['required', new AgeList],
            'currency_id' => ['required', Rule::in(Currency::$actives)],
            'start_date' => ['required', 'date', 'date_format:Y-m-d', 'after:tomorrow'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d', 'after:start_date']
        ];
    }
}
