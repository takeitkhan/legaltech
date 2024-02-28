<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdjustmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'entity_id'       => $this->entity_id,
            'title'           => $this->title,
            'amount'          => $this->amount,
            'adjustment_date' => $this->adjustment_date,
            'adjustment_type' => $this->adjustment_type,
            'vat_rate'        => $this->vat_rate,
            'vat'             => $this->vat,
            'transaction_id'  => $this->transaction_id
        ];
    }
}
