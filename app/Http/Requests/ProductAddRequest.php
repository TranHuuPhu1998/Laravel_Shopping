<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' => 'bail|required|unique:products|min:10|max:255',
            'price' => 'required',
            'category_id' => 'required',
            'content' => 'required|min:10|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép bỏ trống',
            'name.unique' => 'Tên không được trùng',
            'name.min' => 'Tên không được dưới 10 ký tự',
            'name.max' => 'Tên không được quá 255 ký tự',
            'category_id.required' => 'Danh mục không được phép bỏ trống',
            'content.required' => 'Nội dung không được phép bỏ trống',
            'price.required' => 'Giá không được phép bỏ trống',
        ];
    }
}
