<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class articleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255|unique:articles',
            'body'=> 'required',
            'image'=> 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id'=>'required',
        ];
    }
}
