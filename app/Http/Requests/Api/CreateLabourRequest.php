<?php

namespace App\Http\Requests\Api;


class CreateLabourRequest extends BaseAPIRequest
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
        $rules = [
            'cnic' => 'required',
            'registeration_num' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ];
        return $rules;
    }
}
