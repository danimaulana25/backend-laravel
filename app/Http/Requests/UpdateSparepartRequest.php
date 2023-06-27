<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSparepartRequest extends FormRequest
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
        return [];
    }
    // public function rules()
    // {
    //     if (request()->isMethod('post')) {
    //         return [
    //             'name' => 'required|string|max:258',
    //             'color' => 'required|string|max:258',
    //             'material' => 'required|string|max:258',
    //             'price' => 'required',
    //         ];
    //     } else {
    //         return [
    //             'name' => 'required|string|max:258',
    //             'color' => 'required|string|max:258',
    //             'material' => 'required|string|max:258',
    //             'price' => 'required',
    //         ];
    //     }
    // }

    // public function messages()
    // {
    //     if (request()->isMethod('post')) {
    //         return [
    //             'name.required' => 'name is required',
    //             'color.required' => 'color is required',
    //             'material.required' => 'material is required',
    //             'price.required' => 'price is required',
    //         ];
    //     } else {
    //         return [
    //             'name.required' => 'name is required',
    //             'color.required' => 'color is required',
    //             'material.required' => 'material is required',
    //             'price.required' => 'price is required',
    //         ];
    //     }
    // }
}
