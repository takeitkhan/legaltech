<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    //review_status 'submitted','draft','approved'
    //submitted', 'drafted', 'approved', 'rejected'
    protected $fillable = [
        'entity_id',
        'transaction_type_id',
        'invoice_no',
        'transaction_date',
        'transaction_category',
        'document_type_id',
        'document_type',
        'user_id',
        'contact_id',
        'contact_name',
        'contact_code',
        'employee_id',
        'total_taxable_value', //update will
        'total_tax_value', //update will
        'total_sd_value', //update will
        'total_at_value', //update will
        'total_ait', //update will
        'total_rd', //update will
        'total_cd', //update will
        'quantity',
        'review_status',
        'submitted_at',
        // 'drafted_at',//not required
        'approved_at',
        'rejected_at',
        'filed_at',
        'office_code',
        'CPC',
        'item_no',
        'tax_payable',
        'transaction_channel'
    ];

    public function transactionProducts()
    {
        return $this->hasMany(TransactionProduct::class, 'transaction_id', 'id');
    }
    public function documents()
    {
        return $this->hasMany(Document::class, 'transaction_id', 'id');
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id', 'id');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    public function adjustment()
    {
        return $this->hasOne(VATAdjustment::class, 'transaction_id', 'id');
    }
    public function treasuryDeposit()
    {
        return $this->hasOne(TreasuryDeposit::class, 'transaction_id', 'id');
    }
}
