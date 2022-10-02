<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TodoRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'title'=>'string|required',
                ];
            case 'PATCH':
            case 'PUT':
                return [
                    'id'=>'required|numeric',
                    'status'=>Rule::in(['initial', 'in_progress', 'done']),
                ];

        }

    }
}
