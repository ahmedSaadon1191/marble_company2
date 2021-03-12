<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
        return
        [
            'Country_ar'     => 'required',
            'Country_en'    => 'required',
            'city_ar'       => 'required',
            'city_en'       => 'required',
            'adress_ar'     => 'required',
            'adress_en'     => 'required',
            'phone_number'  => 'required',
        ];
    }

    public function messages()
    {
        return
        [

            'Country_ar.required'   => 'اسم الدولة بالعربي مطلوب',
            'Country_en.required'   => 'اسم الدولة بالانجليزية مطلوب',
            'city_ar.required'      => 'اسم المدينة بالعربي مطلوب',
            'city_ar.required'      => 'اسم المدينة بالانجليزية مطلوب',
            'adress_ar.required'    => ' العنوان بالعربي مطلوب',
            'adress_ar.required'    => ' العنوان بالانجليزية مطلوب',
            'phone_number.required' => '  رقم التليفون مطلوب',

        ];
    }
}
