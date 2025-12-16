<?php

return [
    'singular' => 'WorkOrderTransactionsHistory',
    'plural' => 'WorkOrderTransactionsHistories',
    'fields' => [
        'id' => 'Id',
        'work_order_id' => 'Work Order Id',
        'user_id' => 'User Id',
        'work_order_number' => 'Work Order Number',
        'old_status' => 'Old Status',
        'new_status' => 'New Status',
        'old_department' => 'Old Department',
        'new_department' => 'New Department',
        'type' => 'Type',
        'description' => 'Description',
        'note' => 'Note',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
    ],
];
