<?php

return [
    'singular' => 'شهادة الإنجاز',
    'plural' => 'شهادات الإنجاز',
    'fields' => [
        'id' => 'المعرف',
        'work_order_id' => 'رقم أمر العمل',
        'cert_date' => 'تاريخ الشهادة',
        'status' => 'الحالة',
        'amount' => 'قيمة الإجمالي من المقايسة',
        'fines_amount' => 'قيمة الغرامات',
        'net_amount' => 'قيمة الصافي',
        'final_amount' => 'القيمة النهائية',
        'notes' => 'ملاحظات',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'fines_amount_percentage'  => 'نسبة الغرامات'
  ],
    'no work order available' => 'لا يوجد طلب عمل مكتمل او مقايسة معتمدة',
    'cannot change approved coc' => 'الشهادة معتمدة ولا يمكن التعديل عليها',
    'The coc status should be new' => 'يجب ان تكون حالة الشهادة جديدة'
];
