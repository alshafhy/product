<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstallmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sale_invoice_id' => $this->sale_invoice_id,
            'customer_name' => $this->customer ? $this->customer->name : null,
            'amount' => (float) $this->amount,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'paid_date' => $this->paid_date,
            'guarantor_name' => $this->guarantor_name,
        ];
    }
}
