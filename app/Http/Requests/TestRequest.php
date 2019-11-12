<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
            //
            'test_cat_id' => 'required',
            'test_subcat_id' => 'required',
            'image' => 'required',
            'description' => 'required',
            'tableOfContent' => 'required',
            'benefits' => 'required',
            'price' => 'required',
            'time' => 'required',
            'question.*' => 'required',
            'option1.*' => 'required',
            'option2.*' => 'required',
            'option3.*' => 'required',
            'option4.*' => 'required',
            'isCorrect.*' => 'required'
        ];
    }
}
