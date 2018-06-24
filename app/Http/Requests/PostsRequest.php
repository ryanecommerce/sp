<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $dontFlash = ['files'];

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
            'tags' => ['required', 'array'],
            'files' => ['array'],
            'files.*' => ['mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg', 'max:3000000000000'],
        ];
    }


}
