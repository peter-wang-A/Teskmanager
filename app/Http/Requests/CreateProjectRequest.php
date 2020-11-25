<?php

namespace App\Http\Requests;

use Illuminate\Database\Events\TransactionRolledBack;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProjectRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('projects')->where(function ($query) {
                    return $query->where('user_id', request()->user()->id);
                })
            ],
            'thumbnail' => 'image|dimensions:min_with=260,min_height=100'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名称不能为空~',
            'name.unique' => '名称重复了~',
            'thumbnail.image' => '必须上传图片~',
            'thumbnail.dimensions' => '图片最小260*100~',
        ];
    }
}
