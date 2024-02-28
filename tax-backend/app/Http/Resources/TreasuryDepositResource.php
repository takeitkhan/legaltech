<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TreasuryDepositResource extends JsonResource
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
            'id'   => $this->id,
            'treasury_challan_number'   => $this->treasury_challan_number,
            'bank'       => $this->bank,
            'branch'     => $this->branch,
            'district'   => $this->district,
            'date'       => $this->date,
            'entity_id'   => $this->entity_id,
            'deposit_account_code'   => $this->deposit_account_code,
            'deposit_amount'   => $this->deposit_amount,
            'deposit_type'   => $this->deposit_type,
            'transaction_id' => $this->transaction_id
        ];
    }
}
