<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserPostRequest extends FormRequest
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
          'email' => 'required|email',

          'password' => 'required|confirmed',

          'password_confirmation' => 'required|same:password',

          'admin' => 'required',

          'blocked' => 'required',

          'print_evals' => 'required',

          'print_counts' => 'required',

          'department_id' => 'required',
        ];
    }
}
