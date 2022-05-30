<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'key' => 'required',
            'search_by_tag_name' => '',
            'from' => 'required',
            'to' => 'required',
            'tag_active' => 'required',
            'order_by' => 'required',
            'direction' => '',
            'search_by_title' => '',
        ];
    }
}
