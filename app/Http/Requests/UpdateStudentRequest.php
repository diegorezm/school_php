<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
        $method = $this->method();
        if($method === "PUT"){
            return [
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email'],
                'age' => ['required', 'integer'],
                'courseId' => ['required', 'integer', 'exists:courses,id'],
            ];
        }else if($method === "PATCH") {
            return [
                'name' =>   ['sometimes','required', 'string'],
                'email' =>  ['sometimes', 'required', 'string', 'email'],
                'age' =>    ['sometimes', 'required', 'integer'],
                'courseId' => ['sometimes', 'required', 'integer', 'exists:courses,id'],
            ];
        }
    }
}
