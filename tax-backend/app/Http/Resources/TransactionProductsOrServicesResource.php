<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionProductsOrServicesResource extends JsonResource
{
    use BaseResourceTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'transaction_id'    => $this->transaction_id,
            'transaction'    => $this->transaction,
            'entity_product'    => $this->entity_product,
            'entity_product_id' => $this->entity_product_id,
            'product_name'  => $this->product_name,
            'unit'          => $this->unit,
            'unit_price'    => $this->unit_price,
            'qty'        => $this->qty,
            'sd_rate'    => $this->sd_rate,
            'at_rate'    => $this->at_rate,
            'tax_rate'   => $this->tax_rate,
            'taxRate'    => $this->taxRate,
            'ait'    => $this->ait,
            'rd'     => $this->rd,
            'cd'     => $this->cd,
            'taxable_value'   => $this->taxable_value,
            'sd_rate_value'   => $this->sd_rate_value,
            'tax_rate_value'  => $this->tax_rate_value,
            'at_rate_value'   => $this->at_rate_value,
            'tax_rate_id'     => $this->tax_rate_id,
        ];
    }
}
