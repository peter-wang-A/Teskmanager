<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
            'name' => 'required',
            // 'project_id' => [
            //     'required',
            //     'integer',
            //     Rule::exists('project', 'id')->whereIn('id', $this->user()->projects()->pluck('id')->all())
            // ]
        ];
    }


    public function messages()
    {
        return [
            'project_id' => '没有此项目'
        ];
    }
}
