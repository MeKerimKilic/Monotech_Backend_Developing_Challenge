<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PromotionCodeCreateRequest extends FormRequest
{
    /**
     * @var mixed
     */
    private $quota;
    /**
     * @var mixed
     */
    private $amount;
    /**
     * @var mixed
     */
    private $end_date;
    /**
     * @var mixed
     */
    private $start_date;

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
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'amount' => 'required|integer',
            'quota' => 'required|integer'
        ];
    }
    public function messages(): array
    {
        return [
            'start_date.required' => 'Start Date is required'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
