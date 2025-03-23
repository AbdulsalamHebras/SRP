<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class ApplierRequest extends FormRequest
{
    /**
     * تحديد ما إذا كان المستخدم مخولًا لإجراء هذا الطلب.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * القواعد الخاصة بالتحقق من الإدخال.
     */
    public function rules(): array
    {
        $applierId = $this->route('applier') ? $this->route('applier')->id : null;
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('appliers', 'email')->ignore($applierId),],
            'password' => [
                'nullable',
                'confirmed',
                Password::defaults(),
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'phoneNumber' => [
                'required',
                'numeric',
                'digits:9',
                'regex:/^(77|78|71|73|70)\d{7}$/',
                Rule::unique('appliers', 'phoneNumber')->ignore($applierId),
            ],
            'city' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:18', 'max:99'],
            'DOB' => ['required', 'date'],
            'graduationDate'=>['required', 'date'],
            'degree' => ['nullable', 'string', 'max:255'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'CVfile' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'], // 10MB
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'], // 5MB
            'gender' => ['required', 'in:male,female'],
            'languages' => ['nullable', 'array'],
            'languages.*' => ['string', 'max:255'],

        ];
    }

    /**
     * تخصيص رسائل الأخطاء عند الإدخال غير الصحيح.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صالح.',
            'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',
            'password.confirmed' => 'كلمة المرور وتأكيد كلمة المرور لا تتطابق.',
            'phoneNumber.required' => 'رقم الهاتف مطلوب.',
            'phoneNumber.numeric' => 'يجب أن يكون رقم الهاتف أرقامًا فقط.',
            'phoneNumber.digits' => 'يجب أن يكون رقم الهاتف مكونًا من 9 أرقام.',
            'phoneNumber.regex' => 'رقم الهاتف يجب أن يبدأ بـ 77, 78, 71, 73 أو 70.',
            'phoneNumber.unique' => 'هذا الرقم مستخدم بالفعل.',
            'city.max' => 'يجب ألا يتجاوز اسم المدينة 255 حرفًا.',
            'address.required' => 'عنوان السكن مطلوب.',
            'address.max' => 'يجب ألا يتجاوز العنوان 255 حرفًا.',
            'DOB.required' => 'تاريخ الميلاد مطلوب.',
            'DOB.date' => 'يجب أن يكون تاريخ الميلاد تاريخًا صالحًا.',
            'age.integer' => 'يجب أن يكون العمر رقمًا صحيحًا.',
            'age.min' => 'يجب أن يكون العمر 18 سنة على الأقل.',
            'age.max' => 'يجب ألا يتجاوز العمر 99 سنة.',
            'gender.required' => 'يجب اختيار الجنس.',
            'gender.in' => 'القيمة المدخلة غير صحيحة.',
            'degree.max' => 'يجب ألا يتجاوز المؤهل العلمي 255 حرفًا.',
            'specialization.max' => 'يجب ألا يتجاوز التخصص 255 حرفًا.',
            'languages.max' => 'يجب ألا يتجاوز عدد الأحرف في اللغات 255 حرفًا.',
            'graduationDate.date' => 'يجب أن يكون تاريخ التخرج تاريخًا صالحًا.',
            'CVfile.mimes' => 'يجب أن يكون ملف السيرة الذاتية بصيغة PDF أو DOC أو DOCX.',
            'CVfile.max' => 'يجب ألا يتجاوز حجم ملف السيرة الذاتية 10 ميجابايت.',
            'photo.image' => 'يجب أن تكون الصورة بصيغة JPEG أو PNG أو JPG.',
            'photo.max' => 'يجب ألا يتجاوز حجم الصورة 5 ميجابايت.',
        ];
    }
}
