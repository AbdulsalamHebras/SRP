<?php
    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class JobRequest extends FormRequest
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
                'jobName'      => 'required|string|max:255',
                'jobType'      => 'required|in:دوام كامل,دوام جزئي,عن بعد',
                'description'  => 'required|string|min:20',
                'minSalary'    => 'nullable|numeric|min:0',
                'maxSalary'    => 'nullable|numeric|min:0|gte:minSalary',
                'currency'     => 'required|in:YEM,SAR,USD',
                'expirationDate' => 'required|date|after:today',
                'requirements' => 'required|string|min:20',
                'location' => 'required_unless:jobType,عن بعد|string|max:255', // Fixed validation rule
            ];
        }

        /**
         * Get the validation messages for the defined rules.
         */
        public function messages(): array
        {
            return [
                'jobName.required'     => 'اسم الوظيفة مطلوب.',
                'jobName.max'          => 'اسم الوظيفة يجب ألا يزيد عن 255 حرفًا.',
                'jobType.required'     => 'نوع الوظيفة مطلوب.',
                'jobType.in'           => 'نوع الوظيفة يجب أن يكون إما دوام كامل، دوام جزئي، أو عن بعد.',
                'description.required' => 'الوصف مطلوب.',
                'description.min'      => 'الوصف يجب أن يكون على الأقل 20 حرفًا.',
                'minSalary.numeric'    => 'الحد الأدنى للراتب يجب أن يكون رقمًا.',
                'minSalary.min'        => 'الحد الأدنى للراتب لا يمكن أن يكون رقمًا سالبًا.',
                'maxSalary.numeric'    => 'الحد الأقصى للراتب يجب أن يكون رقمًا.',
                'maxSalary.min'        => 'الحد الأقصى للراتب لا يمكن أن يكون رقمًا سالبًا.',
                'maxSalary.gte'        => 'الحد الأقصى للراتب يجب أن يكون أكبر من أو يساوي الحد الأدنى.',
                'currency.required'    => 'العملة مطلوبة.',
                'currency.in'          => 'العملة يجب أن تكون إما ريال يمني، ريال سعودي، أو دولار أمريكي.',
                'expirationDate.required' => 'تاريخ انتهاء الإعلان مطلوب.',
                'expirationDate.date'  => 'يجب إدخال تاريخ صحيح.',
                'expirationDate.after' => 'تاريخ انتهاء الإعلان يجب أن يكون بعد اليوم الحالي.',
                'requirements.required' => 'المتطلبات مطلوبة.',
                'requirements.min'      => 'المتطلبات يجب أن تكون على الأقل 20 حرفًا.',
                'location.required'    => 'الموقع مطلوب.',
                'location.max'         => 'الموقع يجب ألا يزيد عن 255 حرفًا.',
            ];
        }
    }
