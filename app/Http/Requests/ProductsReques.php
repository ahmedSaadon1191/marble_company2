<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsReques extends FormRequest
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
            'name_ar'           => 'required|unique:products,name,'.$this->id,
            'name_en'           => 'required|unique:products,name,'.$this->id,
            'top_product'       => 'required',
        ];
    }

    public function messages()
    {
        return
        [

            'name_ar.required'      => 'اسم المنتج بالعربي مطلوب',
            'name_en.required'      => 'اسم المنتج بالانجليزي مطلوب',
            'name_ar.unique'        => 'اسم المنتج بالعربي موجود بالفعل',
            'name_en.unique'        => 'اسم المنتج بالانجليزي موجود بالفعل',
            'top_product.unique'    => 'برجاء اختيار حالة المنتج',

        ];
    }
}
