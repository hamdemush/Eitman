<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول الحقل :attribute.',
    'accepted_if' => 'يجب قبول الحقل :attribute عندما يكون :other هو :value.',
    'active_url' => 'الحقل :attribute لا يمثل رابطاً صحيحاً.',
    'after' => 'يجب أن يكون الحقل :attribute تاريخاً بعد :date.',
    'after_or_equal' => 'يجب أن يكون الحقل :attribute تاريخاً مساوياً أو بعد :date.',
    'alpha' => 'يجب أن يحتوي الحقل :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي الحقل :attribute على أحرف، أرقام، شرطات وشرطات سفلية فقط.',
    'alpha_num' => 'يجب أن يحتوي الحقل :attribute على أحرف وأرقام فقط.',
    'array' => 'يجب أن يكون الحقل :attribute مصفوفة.',
    'ascii' => 'يجب أن يحتوي الحقل :attribute على رموز وأحرف وأرقام أحادية البايت فقط.',
    'before' => 'يجب أن يكون الحقل :attribute تاريخاً قبل :date.',
    'before_or_equal' => 'يجب أن يكون الحقل :attribute تاريخاً مساوياً أو قبل :date.',
    'between' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على ما بين :min و :max من العناصر.',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute بين :min و :max.',
        'string' => 'يجب أن يكون عدد أحرف الحقل :attribute بين :min و :max أحرف.',
    ],
    'boolean' => 'يجب أن تكون قيمة الحقل :attribute إما صحيحاً أو خاطئاً.',
    'confirmed' => 'حقل التأكيد غير متطابق مع الحقل :attribute.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'الحقل :attribute ليس تاريخاً صحيحاً.',
    'date_equals' => 'يجب أن يكون الحقل :attribute تاريخاً مطابقاً لـ :date.',
    'date_format' => 'الحقل :attribute لا يتوافق مع الصيغة :format.',
    'declined' => 'يجب رفض الحقل :attribute.',
    'declined_if' => 'يجب رفض الحقل :attribute عندما يكون :other هو :value.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مختلفين.',
    'digits' => 'يجب أن يتكون الحقل :attribute من :digits أرقام.',
    'digits_between' => 'يجب أن يكون عدد أرقام الحقل :attribute بين :min و :max أرقام.',
    'dimensions' => 'الحقل :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'الحقل :attribute يحتوي على قيمة مكررة.',
    'doesnt_end_with' => 'يجب ألا ينتهي الحقل :attribute بأي من القيم التالية: :values.',
    'doesnt_start_with' => 'يجب ألا يبدأ الحقل :attribute بأي من القيم التالية: :values.',
    'email' => 'يجب أن يكون الحقل :attribute بريداً إلكترونياً صحيحاً.',
    'ends_with' => 'يجب أن ينتهي الحقل :attribute بأحد القيم التالية: :values.',
    'enum' => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'exists' => 'القيمة المحددة للحقل :attribute غير موجودة.',
    'file' => 'يجب أن يكون الحقل :attribute ملفاً.',
    'filled' => 'الحقل :attribute يجب أن يحتوي على قيمة.',
    'gt' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على أكثر من :value من العناصر.',
        'file' => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute أكبر من :value.',
        'string' => 'يجب أن يكون عدد أحرف الحقل :attribute أكبر من :value من الأحرف.',
    ],
    'gte' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على :value من العناصر أو أكثر.',
        'file' => 'يجب أن يكون حجم الملف :attribute أكبر من أو مساوياً لـ :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute أكبر من أو مساوية لـ :value.',
        'string' => 'يجب أن يكون عدد أحرف الحقل :attribute أكبر من أو مساوياً لـ :value من الأحرف.',
    ],
    'image' => 'يجب أن يكون الحقل :attribute صورة.',
    'in' => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'in_array' => 'الحقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون الحقل :attribute عدداً صحيحاً.',
    'ip' => 'يجب أن يكون الحقل :attribute عنوان IP صحيحاً.',
    'ipv4' => 'يجب أن يكون الحقل :attribute عنوان IPv4 صحيحاً.',
    'ipv6' => 'يجب أن يكون الحقل :attribute عنوان IPv6 صحيحاً.',
    'json' => 'يجب أن يكون الحقل :attribute نصاً بصيغة JSON صحيحة.',
    'lowercase' => 'يجب أن يكون الحقل :attribute مكتوباً بأحرف صغيرة.',
    'lt' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على أقل من :value من العناصر.',
        'file' => 'يجب أن يكون حجم الملف :attribute أقل من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute أقل من :value.',
        'string' => 'يجب أن يكون عدد أحرف الحقل :attribute أقل من :value من الأحرف.',
    ],
    'lte' => [
        'array' => 'يجب ألا يحتوي الحقل :attribute على أكثر من :value من العناصر.',
        'file' => 'يجب أن يكون حجم الملف :attribute أقل من أو مساوياً لـ :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute أقل من أو مساوية لـ :value.',
        'string' => 'يجب أن يكون عدد أحرف الحقل :attribute أقل من أو مساوياً لـ :value من الأحرف.',
    ],
    'mac_address' => 'يجب أن يكون الحقل :attribute عنوان MAC صحيحاً.',
    'max' => [
        'array' => 'يجب ألا يحتوي الحقل :attribute على أكثر من :max من العناصر.',
        'file' => 'يجب ألا يتجاوز حجم الملف :attribute عن :max كيلوبايت.',
        'numeric' => 'يجب ألا تكون قيمة الحقل :attribute أكبر من :max.',
        'string' => 'يجب ألا يتجاوز عدد أحرف الحقل :attribute عن :max أحرف.',
    ],
    'max_digits' => 'يجب ألا يحتوي الحقل :attribute على أكثر من :max أرقام.',
    'mimes' => 'يجب أن يكون الحقل :attribute ملفاً من النوع: :values.',
    'mimetypes' => 'يجب أن يكون الحقل :attribute ملفاً من النوع: :values.',
    'min' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على الأقل على :min من العناصر.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute على الأقل :min.',
        'string' => 'يجب أن يكون عدد أحرف الحقل :attribute على الأقل :min أحرف.',
    ],
    'min_digits' => 'يجب أن يحتوي الحقل :attribute على الأقل على :min من الأرقام.',
    'missing' => 'يجب أن يكون الحقل :attribute مفقوداً.',
    'missing_if' => 'يجب أن يكون الحقل :attribute مفقوداً عندما يكون :other هو :value.',
    'missing_unless' => 'يجب أن يكون الحقل :attribute مفقوداً إلا إذا كان :other هو :value.',
    'missing_with' => 'يجب أن يكون الحقل :attribute مفقوداً عندما يتواجد :values.',
    'missing_with_all' => 'يجب أن يكون الحقل :attribute مفقوداً عندما تتواجد :values.',
    'multiple_of' => 'يجب أن يكون الحقل :attribute مضاعفاً للقيمة :value.',
    'not_in' => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'not_regex' => 'صيغة الحقل :attribute غير صالحة.',
    'numeric' => 'يجب أن يكون الحقل :attribute رقماً.',
    'password' => [
        'letters' => 'يجب أن يحتوي الحقل :attribute على حرف واحد على الأقل.',
        'mixed' => 'يجب أن يحتوي الحقل :attribute على حرف كبير وحرف صغير واحد على الأقل.',
        'numbers' => 'يجب أن يحتوي الحقل :attribute على رقم واحد على الأقل.',
        'symbols' => 'يجب أن يحتوي الحقل :attribute على رمز واحد على الأقل.',
        'uncompromised' => 'الحقل :attribute المحدد ظهر في تسريب بيانات. الرجاء اختيار قيمة أخرى.',
    ],
    'present' => 'يجب أن يكون الحقل :attribute موجوداً.',
    'prohibited' => 'الحقل :attribute محظور.',
    'prohibited_if' => 'الحقل :attribute محظور عندما يكون :other هو :value.',
    'prohibited_unless' => 'الحقل :attribute محظور ما لم يكن :other في :values.',
    'prohibits' => 'الحقل :attribute يحظر وجود الحقل :other.',
    'regex' => 'صيغة الحقل :attribute غير صالحة.',
    'required' => 'الحقل :attribute مطلوب.',
    'required_array_keys' => 'يجب أن يحتوي الحقل :attribute على مفاتيح لـ: :values.',
    'required_if' => 'الحقل :attribute مطلوب عندما يكون :other هو :value.',
    'required_if_accepted' => 'الحقل :attribute مطلوب عندما يتم قبول :other.',
    'required_unless' => 'الحقل :attribute مطلوب ما لم يكن :other في :values.',
    'required_with' => 'الحقل :attribute مطلوب عندما يكون :values موجوداً.',
    'required_with_all' => 'الحقل :attribute مطلوب عندما تكون :values موجودة.',
    'required_without' => 'الحقل :attribute مطلوب عندما لا يكون :values موجوداً.',
    'required_without_all' => 'الحقل :attribute مطلوب عندما لا تكون أي من :values موجودة.',
    'same' => 'يجب أن يتطابق الحقل :attribute مع :other.',
    'size' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على :size من العناصر بالضبط.',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت بالضبط.',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية لـ :size بالضبط.',
        'string' => 'يجب أن يتكون الحقل :attribute من :size أحرف بالضبط.',
    ],
    'starts_with' => 'يجب أن يبدأ الحقل :attribute بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون الحقل :attribute نصاً.',
    'timezone' => 'يجب أن يكون الحقل :attribute نطاقاً زمنياً صحيحاً.',
    'unique' => 'قيمة الحقل :attribute مُستخدمة من قبل بقاعدة البيانات.',
    'uploaded' => 'فشل تحميل الحقل :attribute.',
    'uppercase' => 'يجب أن يكون الحقل :attribute مكتوباً بأحرف كبيرة.',
    'url' => 'يجب أن يكون الحقل :attribute رابطاً صحيحاً.',
    'ulid' => 'يجب أن يكون الحقل :attribute معرف ULID صحيحاً.',
    'uuid' => 'يجب أن يكون الحقل :attribute معرف UUID صحيحاً.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */
    'attributes' => [
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'name' => 'الاسم',
        'phone' => 'رقم الهاتف',
        'appointment_date' => 'تاريخ الموعد',
    ],

];