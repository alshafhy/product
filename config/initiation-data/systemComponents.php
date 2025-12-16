<?php

return [
    /***********التعريفات العامة */
    // 'commonScreens' => [
    //     'comp_name'=> 'التعريفات العامة',
    //     'comp_type'=> 1,
    //     'route_name'=> 'commonScreens',
    //     'prefix'=> '',
    //     'model_name'=> '',
    //     'parent_route_name'=> '',
    //     'icon'=> ''

    // ],
    /********** ادارة المستخدمين*/
    'userManagement' => [
        'comp_name' => 'ادارة المستخدمين',
        'comp_type' => 1,
        'route_name' => 'userManagement',
        'prefix' => 'userManagement',
        'model_name' => '',
        'parent_route_name' => '',
        'icon' => 'users'
    ],
    'users' => [
        'comp_name' => 'المستخدمين',
        'comp_type' => 3,
        'route_name' => 'users',
        'prefix' => 'userManagement',
        'model_name' => 'users',
        'parent_route_name' => 'userManagement',
        'icon' => ''
    ],
    'roles' => [
        'comp_name' => 'صلاحيات المستخدمين',
        'comp_type' => 3,
        'route_name' => 'roles',
        'prefix' => 'userManagement',
        'model_name' => 'roles',
        'parent_route_name' => 'userManagement',
        'icon' => ''
    ],
    /********** الموظفين*/

    // 'reports' => [
    //     'comp_name'=> 'التقارير العامة',
    //     'comp_type'=> 1,
    //     'route_name'=> 'reports',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> '',
    //     'icon'=> 'file-text'
    // ],
    // 'workOrdersGeneralReport' => [
    //     'comp_name'=> 'متابعة أوامر العمل',
    //     'description'=> 'تقرير متابعة أوامر العمل',
    //     'comp_type'=> 4,
    //     'route_name'=> 'workOrdersGeneralReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'reports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.work_orders_reports.general_report.report",
    //         "reportFilterTemplate": "reports.work_orders_reports.general_report.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": ["view", "print", "download", "search"]
    //     }'
    // ],
    // 'drillingWorkOrdersReport' => [
    //     'comp_name'=> 'تقارير أعمال الحفر',
    //     'comp_type'=> 1,
    //     'route_name'=> 'drillingWorkOrdersReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> '',
    //     'icon'=> 'file-text'
    // ],
    // 'unfinishedDrillingWorkOrdersReport' => [
    //     'comp_name'=> 'أوامر العمل المستلمة',
    //     'description'=> 'تقرير عن حالة أعمال الحفر والتمديدات لأوامر العمل المستلمة فى فترة',
    //     'comp_type'=> 4,
    //     'route_name'=> 'unfinishedDrillingWorkOrdersReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'drillingWorkOrdersReport',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.drilling_work_orders.unfinished_work_orders.report",
    //         "reportFilterTemplate": "reports.drilling_work_orders.unfinished_work_orders.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": ["view", "print", "download", "search"]
    //     }'
    // ],
    // 'finishedDrillingWorkOrdersReport' => [
    //     'comp_name'=> 'أوامر العمل المنفذة',
    //     'description'=> 'تقرير عن حالة أعمال الحفر والتمديدات المنفذة فى فترة',
    //     'comp_type'=> 4,
    //     'route_name'=> 'finishedDrillingWorkOrdersReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'drillingWorkOrdersReport',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.drilling_work_orders.finished_work_orders.report",
    //         "reportFilterTemplate": "reports.drilling_work_orders.finished_work_orders.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": ["view", "print", "download", "search"]
    //     }'
    // ],
    // 'electricyReports' => [
    //     'comp_name'=> 'تقارير أعمال الكهرباء',
    //     'comp_type'=> 1,
    //     'route_name'=> 'electricyReports',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> '',
    //     'icon'=> 'file-text'
    // ],
    // 'finishedElectricyWorkOrdersReport' => [
    //     'comp_name'=> 'أوامر العمل المنجزة',
    //     'description'=> 'تقرير أوامر العمل المنجزة لقسم الاعمال الكهربائية',
    //     'comp_type'=> 4,
    //     'route_name'=> 'finishedElectricyWorkOrdersReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'electricyReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.electricy_work_orders.finished_work_orders.report",
    //         "reportFilterTemplate": "reports.electricy_work_orders.finished_work_orders.filter",
    //         "font_name": "calibri",
    //         "font_size": "11",
    //         "title_background_color": "4CAF50",
    //         "orientation": "P",
    //         "reportButtons": [
    //             "view",
    //             "print",
    //             "download",
    //             "search"
    //         ]
    //     }'
    // ],
    // 'electricyOperationsReport' => [
    //     'comp_name'=> 'التركيبات الكهربائية',
    //     'description'=> 'التقرير الفني لمعاملات التركيبات الكهربائية',
    //     'comp_type'=> 4,
    //     'route_name'=> 'electricyOperationsReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'electricyReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.electricy_work_orders.electricy_operations.report",
    //         "reportFilterTemplate": "reports.electricy_work_orders.electricy_operations.filter",
    //         "font_name": "calibri",
    //         "font_size": "11",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": [
    //             "view",
    //             "print",
    //             "download",
    //             "search"
    //         ]
    //     }'
    // ],
    // 'electricyCountersReport' => [
    //     'comp_name'=> 'معاملات العدادات',
    //     'description'=> 'التقرير الفني لمعاملات العدادات',
    //     'comp_type'=> 4,
    //     'route_name'=> 'electricyCountersReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'electricyReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.electricy_work_orders.electricy_counters.report",
    //         "reportFilterTemplate": "reports.electricy_work_orders.electricy_counters.filter",
    //         "font_name": "calibri",
    //         "font_size": "11",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": [
    //             "view",
    //             "print",
    //             "download",
    //             "search"
    //         ]
    //     }'
    // ],
    // 'electricTowersReports' => [
    //     'comp_name'=> 'تقارير أعمال الهوائى',
    //     'comp_type'=> 1,
    //     'route_name'=> 'electricTowersReports',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> '',
    //     'icon'=> 'file-text'
    // ],
    // 'electricTowerWorkOrdersReport' => [
    //     'comp_name'=> 'تقرير المتابعة اليومى',
    //     'description'=> 'تقرير متابعة أعمال الهوائى',
    //     'comp_type'=> 4,
    //     'route_name'=> 'electricTowerWorkOrdersReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'electricTowersReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.electric_towers.electric_tower_opreations.report",
    //         "reportFilterTemplate": "reports.electric_towers.electric_tower_opreations.filter",
    //         "font_name": "calibri",
    //         "font_size": "11",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": [
    //             "view",
    //             "print",
    //             "download",
    //             "search"
    //         ]
    //     }'
    // ],
    // 'permitReports' => [
    //     'comp_name'=> 'تقارير اعادة الوضع',
    //     'comp_type'=> 1,
    //     'route_name'=> 'permitReports',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> '',
    //     'icon'=> 'file-text'
    // ],
    // 'workOrdersPermitReport' => [
    //     'comp_name'=> 'متابعة',
    //     'description'=> 'تقرير بيان بوضع فى فترة',
    //     'comp_type'=> 4,
    //     'route_name'=> 'workOrdersPermitReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'permitReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.permitFollow.work_orders_permits.report",
    //         "reportFilterTemplate": "reports.permitFollow.work_orders_permits.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": [
    //             "view",
    //             "print",
    //             "download",
    //             "search"
    //         ]
    //     }'
    // ],


    // 'emergencyMissionsreports' => [
    //     'comp_name'=> 'تقارير أعمال الطوارئ',
    //     'description'=> 'تقارير أعمال الطوارئ',
    //     'comp_type'=> 1,
    //     'route_name'=> 'emergencyMissionsreports',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> '',
    //     'icon'=> 'file-text'
    // ],
    // 'emergencyMissionsDailyReport' => [
    //     'comp_name'=> 'التقرير اليومى ',
    //     'description'=> 'التقرير اليومى ',
    //     'comp_type'=> 4,
    //     'route_name'=> 'emergencyMissionsDailyReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'emergencyMissionsreports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.emergency_missions.daily_missions.report",
    //         "reportFilterTemplate": "reports.emergency_missions.daily_missions.filter",
    //         "font_name": "calibri",
    //         "font_size": "11",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": [
    //             "view",
    //             "print",
    //             "download",
    //             "search"
    //         ]
    //     }'
    // ],
    // 'financialDuesReports' => [
    //     'comp_name'=> 'تقارير المستخلصات',
    //     'description'=> 'تقارير المستخلصات',
    //     'comp_type'=> 1,
    //     'route_name'=> 'financialDuesReports',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> '',
    //     'icon'=> 'file-text'
    // ],
    // 'ordersWithOutCertificatesReport' => [
    //     'comp_name'=> 'طلبات بدون شهادة',
    //     'description'=> 'تقرير الطلبات المنفذة على الطبيعة ولو يصدر لها شهادة انجاز ',
    //     'comp_type'=> 4,
    //     'route_name'=> 'ordersWithOutCertificatesReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'financialDuesReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.financial_dues.orders_with_out_certificates.report",
    //         "reportFilterTemplate": "reports.financial_dues.orders_with_out_certificates.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": ["view", "print", "download", "search"]
    //     }',  
    // ],
    // 'ordersWithOutFinancialDuesReport' => [
    //     'comp_name'=> 'طلبات بدون مستخلص ',
    //     'description'=> 'تقرير الطلبات التى صدر لها شهادة انجاز ولم تدخل مستخلص ',
    //     'comp_type'=> 4,
    //     'route_name'=> 'ordersWithOutFinancialDuesReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'financialDuesReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.financial_dues.orders_with_out_financial_dues.report",
    //         "reportFilterTemplate": "reports.financial_dues.orders_with_out_financial_dues.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": ["view", "print", "download", "search"]
    //     }',  
    // ],
    // 'finishedFinancialDuesReport' => [
    //     'comp_name'=> 'منتهى على الطبيعة ',
    //     'description'=> 'تقرير طلبات منتهية على الطبيعة وصادر لها شهادة ',
    //     'comp_type'=> 4,
    //     'route_name'=> 'finishedFinancialDuesReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'financialDuesReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.financial_dues.finished_financial_dues.report",
    //         "reportFilterTemplate": "reports.financial_dues.finished_financial_dues.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": ["view", "print", "download", "search"]
    //     }',  
    // ],
    // 'allFinancialDuesReport' => [
    //     'comp_name'=> 'طلبات شامل مستلمة ',
    //     'description'=> 'تقرير طلبات شامل مستلمة من الشركة خلال فترة ',
    //     'comp_type'=> 4,
    //     'route_name'=> 'allFinancialDuesReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'financialDuesReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.financial_dues.all_financial_dues.report",
    //         "reportFilterTemplate": "reports.financial_dues.all_financial_dues.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": ["view", "print", "download", "search"]
    //     }',  
    // ],
    // 'topManagementReports' => [
    //     'comp_name'=> 'تقارير الادارة العليا',
    //     'comp_type'=> 1,
    //     'route_name'=> 'topManagementReports',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> '',
    //     'icon'=> 'file-text'
    // ],
    // 'allRecivedOrdersReport' => [
    //     'comp_name'=> 'اجمالى المعاملات الواردة ',
    //     'description'=> 'اجمالى المعاملات الواردة ',
    //     'comp_type'=> 4,
    //     'route_name'=> 'allRecivedOrdersReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'topManagementReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.top_management_reports.all_recived_orders.report",
    //         "reportFilterTemplate": "reports.top_management_reports.all_recived_orders.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": ["view", "print", "download", "search"]
    //     }',  
    // ],
    // 'totalPermitAmountsReport' => [
    //     'comp_name'=> 'مبالغ ',
    //     'description'=> 'بيان بالمبالغ المسددة على مستوى ',
    //     'comp_type'=> 4,
    //     'route_name'=> 'totalPermitAmountsReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'topManagementReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.top_management_reports.total_permit_amounts.report",
    //         "reportFilterTemplate": "reports.top_management_reports.total_permit_amounts.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "L",
    //         "reportButtons": ["view", "print", "download", "search"]
    //     }',  
    // ],
    // 'permitFinesAmountsReport' => [
    //     'comp_name'=> 'المخالفات ',
    //     'description'=> 'بيان بالمخالفات لكل موقع (التصاريح) ',
    //     'comp_type'=> 4,
    //     'route_name'=> 'permitFinesAmountsReport',
    //     'prefix'=> 'reports',
    //     'model_name'=> '',
    //     'parent_route_name'=> 'topManagementReports',
    //     'icon'=> '',
    //     'config'=>'{
    //         "reportTemplate": "reports.top_management_reports.permit_fines_amounts.report",
    //         "reportFilterTemplate": "reports.top_management_reports.permit_fines_amounts.filter",
    //         "font_name": "calibri",
    //         "font_size": "13",
    //         "title_background_color": "4CAF50",
    //         "orientation": "P",
    //         "reportButtons": ["view", "print", "download", "search"]
    //     }',  
    // ],

];
