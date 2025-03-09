<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
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

    /**
     * Get the validation messages for the defined rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'اسم الشركة مطلوب.',
            'name.max' => 'اسم الشركة يجب ألا يتجاوز 255 حرفًا.',
            'name.unique' => 'اسم الشركة موجود بالفعل.',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صالح.',
            'email.unique' => 'البريد الإلكتروني موجود بالفعل.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.confirmed' => 'كلمة المرور وتأكيد كلمة المرور لا تتطابق.',
            'password.regex' => 'كلمة المرور يجب أن تحتوي على حرف كبير، حرف صغير، رقم، ورمز خاص.',
            'commercialRegister.required' => 'السجل التجاري مطلوب.',
            'commercialRegister.mimes' => 'صيغة الملف يجب أن تكون jpeg، png، أو pdf.',
            'commercialRegister.max' => 'حجم الملف يجب ألا يتجاوز 10 ميجابايت.',
            'jobField.required' => 'مجال العمل مطلوب.',
            'jobField.max' => 'مجال العمل يجب ألا يتجاوز 255 حرفًا.',
            'location.required' => 'الموقع مطلوب.',
            'location.max' => 'الموقع يجب ألا يتجاوز 255 حرفًا.',
            'mission.required' => 'المهمة مطلوبة.',
            'vision.required' => 'الرؤية مطلوبة.',
            'dateOfCreation.required' => 'تاريخ الإنشاء مطلوب.',
            'dateOfCreation.before' => 'تاريخ الإنشاء يجب أن يكون قبل اليوم.',
            'aboutus.required' => 'معلومات عن الشركة مطلوبة.',
            'logo.required' => 'الشعار مطلوب.',
            'logo.image' => 'يجب أن يكون الشعار صورة.',
            'logo.mimes' => 'صيغة الصورة يجب أن تكون jpeg، png، أو jpg.',
            'logo.max' => 'حجم الصورة يجب ألا يتجاوز 5 ميجابايت.',
            'phoneNumber.required' => 'رقم الهاتف مطلوب.',
            'phoneNumber.numeric' => 'رقم الهاتف يجب أن يكون رقماً.',
            'phoneNumber.digits' => 'رقم الهاتف يجب أن يتكون من 9 أرقام.',
            'phoneNumber.regex' => 'رقم الهاتف يجب أن يبدأ بأحد الأرقام 77، 78، 71، 73، 70.',
            'phoneNumber.unique' => 'رقم الهاتف موجود بالفعل.',
            'website.required' => 'رابط الموقع الإلكتروني مطلوب.',
            'website.url' => 'رابط الموقع الإلكتروني يجب أن يكون صالحًا.',
        ];
    }
}
