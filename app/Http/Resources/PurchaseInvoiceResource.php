<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseInvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'total' => (float) $this->total,
            'paid' => (float) $this->paid,
            'remaining' => (float) $this->remaining,
            'status' => $this->status,
            'invoiced_at' => $this->invoiced_at,
        ];
    }
}
