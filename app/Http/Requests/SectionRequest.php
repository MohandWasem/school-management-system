<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'Name_Section_Ar'=>'required',
            'Name_Section_En'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'Name_Section_Ar.required'=>trans('validation.required'),
            'Name_Section_En.required'=>trans('validation.required'),

        ];
    }
}
