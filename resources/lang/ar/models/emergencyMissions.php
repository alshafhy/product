<?php

return array (
  'singular' => 'مهمة طوارئ',
  'plural' => 'مهمات الطوارئ',
  'attachments'=>'المرفقات على المهمة',
  'add_new_attachment'=>'اضافة مرفق جديد',
  'convert_to_work_order'=>'انشاء أمر العمل بطريقة ألية',
  'validations' =>[
    'noWorkOrdersPermitsFound' => 'عفوا لا يمكن تحويل مهمة الطوارئ الى ادارة اعادة الوضع والتسليم الا ان يكون هناك تصريح بلدية فعال مرتبط بها',
  ],
  'fields' =>
  array (
    'id' => 'معرف أمر العمل',
    'work_order_number' => 'رقم أمر العمل',
    'mission_number' => 'رقم المهمة',
    'reference_number' => 'الرقم المرجعى',
    'parent_id' => 'أمر العمل المرتبط',
    'received_date' => 'تاريخ استلام المهمة',
    'district_name' => 'اسم الحى',
    'street_name' => 'اسم الشارع',
    'customer_number' => 'رقم الاشتراك',
    'customer_name' => 'اسم المشترك',
    'customer_mobile_number' => 'رقم جوال المشترك',
    'mission_meter_number' => 'رقم الحساب للعداد',
    'mission_operation_number' => 'رقم تصريح العمليات',
    'mission_received_employee' => 'اسم الفنى مستلم البلاغ',
    'mission_received_employee_short' => 'الفنى المستلم',
    'mission_done_employee' => 'اسم الفنى منفذ البلاغ',
    'mission_done_employee_short' => 'الفنى المنفذ',
    'mission_typeـid' => 'نوع المهمة',
    'shift_number' => 'الوردية',
    'electricity_employee_name' => 'اسم مراقب شركة الكهرباء',
    'description' => 'شرح العطل',
    'notes' => 'ملاحظات',
    'electrical_station_number' => 'رقم المحطة',
    'electricity_company_employee_id' => 'مشرف شركة الكهرباء',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
    'created_by' => 'منشئ المهمة'
  ),
);
