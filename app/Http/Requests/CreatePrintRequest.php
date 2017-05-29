<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePrintRequest extends FormRequest
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
            'description' => 'bail|required|max:255',
            'due_date' => 'nullable|date|after:yesterday',
            'quantity' => 'required|integer|min:1',
            'paper_size' => 'required',
            'paper_type' => 'required',
            'file' => 'required|mimes:png,gif,jpg,jpeg,svg,odt,pdf,docx,doc,xls,xlsx,tiff',
            'print_type' => 'required',
            'stapled' => 'required'
        ];
    }
}
