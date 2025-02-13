<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        'name' => ['required', 'string', 'max:255', 'unique:companies,name'],
        'email' => ['required', 'email', 'unique:companies,email'],
        'password' => ['required', 'confirmed', 'min:8'],
        'commercialRegister' => ['required', 'file', 'mimes:jpeg,png,pdf', 'max:10240'],
        'jobField' => ['required', 'string', 'max:255'],
        'location' => ['required', 'string', 'max:255'],
        'mission' => ['required', 'string'],
        'vision' => ['required', 'string'],
        'dateOfCreation' => ['required', 'date', 'before:today'], // Ensures the date is before today
        'aboutus' => ['required', 'string'],
        'logo' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        'phoneNumber' => [
            'required',
            'numeric',
            'digits:9',
            'regex:/^(77|78|71|73|70)\d{7}$/',
            'unique:companies,phoneNumber'
        ],
        'website' => ['required', 'url'],


            ];
    }
}