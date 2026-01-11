<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class MemberCategoryRequest extends FormRequest
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
            'name' => 'required|max:191',
            'status' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('user.name'),
            'status' => __('user.status'),
        ];
    }
}
