<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'name' => 'required',
                        'price' => 'required|between:0,99.99|min:0',
                        'main_image' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
                        'description' => 'required',
                        'images.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => 'required',
                        'price' => 'required|between:0,99.99|min:0',
                        'main_image' => 'mimes:jpeg,jpg,png,gif|max:2048',
                        'description' => 'required',
                        'images.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
                    ];
                }
            default:break;
        }
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'images.*.mimes' => 'Image must be a file of type: jpeg, jpg, png, gif.',
            'images.*.max' => 'Image may not be greater than 2048 kilobytes.'
        ];
    }
}
