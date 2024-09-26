<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'amount' => 'required',
            'Grade_id' => 'required|integer|exists:grades,id',
            'Classroom_id' => 'required|integer|exists:classrooms,id',
            'description' => 'nullable|string',
            'year' => 'required|integer|min:2000',
            'Fee_type' => 'required|integer',
        ];
    }
}
