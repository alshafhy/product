<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleInvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'total' => (float) $this->total,
            'paid' => (float) $this->paid,
            'remaining' => (float) $this->remaining,
            'status' => $this->status,
            'invoiced_at' => $this->invoiced_at,
            'items' => SaleInvoiceItemResource::collection($this->whenLoaded('items')),
        ];
    }
}

class SaleInvoiceItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'product_name' => $this->product_name,
            'quantity' => (float) $this->quantity,
            'unit_name' => $this->unit_name,
            'sell_price' => (float) $this->sell_price,
            'line_total' => (float) $this->line_total,
        ];
    }
}
