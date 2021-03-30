<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        /* return parent::toArray($request); */
        return [
            "id" => $this->id,
            "payment_method"    => $this->payment_method,
            "status"            => $this->status,
            "note"              => $this->note,
            "total_amount"      => $this->total_amount,
            "created_at"        => $this->created_at,
            "updated_at"        => $this->updated_at,
            'client'            => new ClientResource($this->whenLoaded('client')),
            'address'           => new ClientAddressResource($this->whenLoaded('address')),
            'products'          => new ProductResource($this->whenLoaded('products')),
            'tax'               => new TaxValueResource($this->whenLoaded('tax')),
            'delivery_fee'      => new DeliveryFeeResource($this->whenLoaded('delivery_fee')),
        ];
    }
}
