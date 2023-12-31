<?php

namespace App\Http\Resources;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailStockReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var OrderDetail|JsonResource $this */
        return [
            'id'            => $this->id,
            'order_id'      => $this->order_id,
            'stock_id'      => $this->stock_id,
            'origin_price'  => $this->rate_origin_price,
            'total_price'   => $this->rate_total_price,
            'tax'           => $this->rate_tax,
            'discount'      => $this->rate_discount,
            'quantity'      => $this->quantity,
            'bonus'         => (boolean)$this->bonus,
            'created_at'    => $this->when($this->created_at, $this->created_at?->format('Y-m-d H:i:s') . 'Z'),
            'updated_at'    => $this->when($this->updated_at, $this->updated_at?->format('Y-m-d H:i:s') . 'Z'),

            // Relations
            'order'         => OrderResource::make($this->whenLoaded('orderTrashed')),
        ];
    }
}
