<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImgRequest extends FormRequest
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
            'tiny_img'      => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'max_img'       => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color_name_ar' => 'required',
            'color_name_en' => 'required',
            'code_img'      => 'required|unique:product_imgs,code_img,'.$this->id,
        ];
    }

    public function messages()
    {
        return
        [
            'tiny_img.required'             => 'الصورة الخاصة باللون مطلوبة',
            'max_img.required'              => 'الصورة الخاصة بالاعمال السابقة مطلوبة',
            'tiny_img.mimes'                => 'الصورة يجب ان تكون من نوع jpeg png او jpg او gif  او svg',
            'max_img.mimes'                 => 'الصورة يجب ان تكون من نوع jpeg png او jpg او gif  او svg',
            'tiny_img.max'                  => 'اقصي حجم للصورة هو  2048 px',
            'max_img.max'                   => 'اقصي حجم للصورة هو  2048 px',
            'color_name_ar.required'        => 'اللون بالعربي مطلوب',
            'color_name_en.required'        => 'اللون بالانجليزية مطلوب',
            'code_img.required'             => ' كود الصور مطلوب',
            'code_img.unique'               => ' كود الصور موجود بالفعل من قبل',
        ];
    }
}
