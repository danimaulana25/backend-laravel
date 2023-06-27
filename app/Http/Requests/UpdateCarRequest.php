<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            return [
                'name' => 'required|string|max:258',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'brandsName' => 'required|string',
                'typesName' => 'required|string',
                'price' => 'required',
                'color' => 'required|string',
                'year' => 'required',
                'stok' => 'required',
            ];
        } else {
            return [
                'name' => 'required|string|max:258',
                'brandsName' => 'required|string',
                'typesName' => 'required|string',
                'price' => 'required',
                'color' => 'required|string',
                'year' => 'required',
                'stok' => 'required',
            ];
        }
    }

    public function messages()
    {
        if (request()->isMethod('post')) {
            return [
                'name.required' => 'name is required',
                'image.required' => 'image is required',
                'brandsName.required' => 'brand is required',
                'typesName.required' => 'type is required',
                'price.required' => 'price is required',
                'color.required' => 'color is required',
                'year.required' => 'year is required',
                'stok.required' => 'stok is required',
            ];
        } else {
            return [
                'name.required' => 'name is required',
                'brandsName.required' => 'brand is required',
                'typesName.required' => 'type is required',
                'price.required' => 'price is required',
                'color.required' => 'color is required',
                'year.required' => 'year is required',
                'stok.required' => 'stok is required',
            ];
        }
    }
}
