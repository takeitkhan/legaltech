<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailsResource extends JsonResource
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
            'id'                      =>  $this->id,
            'entity_id'               =>  $this->entity_id,
            'transaction_type_id'     =>  $this->transaction_type_id,
            'transactionType'         =>  $this->transactionType->title,
            'invoice_no'              =>  $this->invoice_no,
            'transaction_date'        =>  $this->transaction_date,
            'transaction_category'    =>  $this->transaction_category,
            'document_type_id'        =>  $this->document_type_id,
            'document_type'           =>  $this->document_type,
            'user_id'                 =>  $this->user_id,
            'contact_id'              =>  $this->contact_id,
            'contact'                 =>  $this->contact,
            'contact_name'            =>  $this->contact_name,
            'contact_code'            =>  $this->contact_code,
            'employee_id'             =>  $this->employee_id,
            'total_taxable_value'     =>  $this->total_taxable_value,
            'total_tax_value'         =>  $this->total_tax_value,
            'total_sd_value'          =>  $this->total_sd_value,
            'total_at_value'          =>  $this->total_at_value,
            'total_ait'               =>  $this->total_ait,
            'total_rd'                =>  $this->total_rd,
            'total_cd'                =>  $this->total_cd,
            'quantity'                =>  $this->quantity,
            'review_status'           =>  $this->review_status,
            'submitted_at'            =>  $this->submitted_at,
            //'drafted_at'            =>  $this->drafted_at,
            'approved_at'             =>  $this->approved_at,
            'rejected_at'             =>  $this->rejected_at,
            'filed_at'                =>  $this->filed_at,
            'office_code'             =>  $this->office_code,
            'CPC'                     =>  $this->CPC,
            'item_no'                 =>  $this->item_no,
            'tax_payable'             => $this->tax_payable,
            'transaction_channel'     => $this->transaction_channel,
            'transactionsProducts'    => TransactionProductsOrServicesResource::collection($this->transactionProducts),
            'treasuryDeposit'         => new TreasuryDepositResource($this->treasuryDeposit),
            'adjustment'              => new AdjustmentResource($this->adjustment),

        ];
    }
}
