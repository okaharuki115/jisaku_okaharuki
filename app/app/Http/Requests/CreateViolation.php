<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateViolation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//return false→return trueにした　認証の切り分けは行わないのでreturn true(常に通す)にする
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //ここにルールを記述
            'comment' => 'required',
        ];
    }
}
