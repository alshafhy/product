<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code_id' => $this->code_id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'sell_price' => (float) $this->sell_price,
            'buy_price' => (float) $this->buy_price,
            'quantity' => (float) $this->quantity,
            'unit1' => $this->unit1,
            'unit2' => $this->unit2,
            'unit3' => $this->unit3,
            'branch_id' => $this->branch_id,
        ];
    }
}
