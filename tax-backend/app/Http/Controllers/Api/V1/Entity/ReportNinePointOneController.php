<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use Illuminate\Http\Request;
use App\Helpers\V1\ReportNinePointOneHelper;
use App\Http\Resources\AdjustmentResource;
use App\Models\VATAdjustment;

class ReportNinePointOneController extends Controller
{
    public function sellsTransactionDetailsViaDate($entity_id, $date)
    {
        $transactionsProducts = ReportNinePointOneHelper::transactionProductsViaTransactionTypeWithDate($entity_id, $date, 2);
        return response()->json(compact('transactionsProducts'));
    }

    public function sellsTransactionDetailsViaDateRange($entity_id, $fromDate, $toDate)
    {
        $transactionsProducts = ReportNinePointOneHelper::transactionProductsViaTransactionTypeWithDateRange($entity_id, $fromDate, $toDate, 2);
        return response()->json(compact('transactionsProducts'));
    }


    public function purchaseTransactionDetailsViaDate($entity_id, $date)
    {
        $transactionsProducts = ReportNinePointOneHelper::transactionProductsViaTransactionTypeWithDate($entity_id, $date, 1);
        return response()->json(compact('transactionsProducts'));
    }

    public function purchaseTransactionDetailsViaDateRange($entity_id, $fromDate, $toDate)
    {
        $transactionsProducts = ReportNinePointOneHelper::transactionProductsViaTransactionTypeWithDateRange($entity_id, $fromDate, $toDate, 1);
        return response()->json(compact('transactionsProducts'));
    }

    //for transaction sub form details page
    public function getLocalTransactionDetailsInDateRange($entity_id, $note, $fromDate, $toDate, $transaction_type)
    {
        $taxRate      = ReportNinePointOneHelper::getTaxRateViaNote($note);
        $transactionProducts = TransactionProduct::with(['transactionType', 'transaction.contact', 'entity', 'transactionProducts', 'contact'])->join('transactions', 'transactions.id', '=', 'transaction_products.transaction_id')
            ->join('contacts', 'transactions.contact_id', '=', 'contacts.id')
            ->where(function ($query) use ($entity_id, $fromDate, $toDate, $transaction_type, $taxRate) {
                $conditionArray = [
                    ['transactions.transaction_date', '>=', $fromDate],
                    ['transactions.transaction_date', '<=', $toDate],
                    ['transactions.entity_id', '=', $entity_id],
                    ['transactions.transaction_type_id', '=', $transaction_type],
                    // ['transactions.transaction_category','=','local'],//may be use in future
                    ['transactions.review_status', '=', 'approved']
                ];
                // if($note === 5){
                //     array_push($conditionArray,['tax_rate','=',5]);
                //     array_push($conditionArray,['is_MRP','=',1]);
                // }
                if ($taxRate === 'non standard') {
                    array_push($conditionArray, ['transaction_products.tax_rate', '>', 0]);
                    array_push($conditionArray, ['transaction_products.tax_rate', '<', 15]);
                    array_push($conditionArray, ['contacts.bin', '<>', null]);
                } elseif ($taxRate === 'unregistered') {
                    //FOR UNREGISTERED ENTITITIES TAX RATE SHOULD BE < 15
                    array_push($conditionArray, ['transaction_products.tax_rate', '>', 0]);
                    array_push($conditionArray, ['transaction_products.tax_rate', '<', 15]);
                    array_push($conditionArray, ['contacts.bin', '=', null]);
                } else {
                    array_push($conditionArray, ['transaction_products.tax_rate', '=', $taxRate]);
                }
                $query->where($conditionArray);
            })->select('transaction_products.*')->get();
        if (!$transactionProducts) {
            return response()->json(['error' => 'Transactions Not Found'], 404);
        }
        return response()->json(compact('transactionProducts'));
    }


    public function getLocalTransactionDetailsInDate($entity_id, $note, $date, $transaction_type)
    {
        $taxRate      = ReportNinePointOneHelper::getTaxRateViaNote($note);
        $transactionProducts = TransactionProduct::with(['transaction', 'transaction.contact', 'entity_product'])
            ->join('transactions', 'transaction_products.transaction_id', '=', 'transactions.id')
            ->join('contacts', 'transactions.contact_id', '=', 'contacts.id')
            ->where(function ($query) use ($entity_id, $date, $transaction_type, $taxRate) {
                $conditionArray  = [
                    ['transactions.entity_id', '=', $entity_id],
                    ['transactions.transaction_type_id', '=', $transaction_type], //1=PURCHASE,2=SELL,4=treasury Deposit,5=adjustment
                    // ['transactions.transaction_category','=','local'],its import for purchase //this is removed for temporary may be will be use in future
                    ['transactions.review_status', '=', 'approved']
                ];
                //for temporary condition
                // if($note == 5){
                //     array_push($conditionArray,['tax_rate','=',5]);
                //     array_push($conditionArray,['is_MRP','=',1]);
                // }
                if ($transaction_type == 1) {
                    array_push($conditionArray, ['transactions.transaction_category', '=', 'local']);
                }
                //for transaction type === 1 or purchase
                if ($taxRate === 'non standard' && $transaction_type == 1) {
                    array_push($conditionArray, ['transaction_products.tax_rate', '>', 0]);
                    array_push($conditionArray, ['transaction_products.tax_rate', '<', 15]);
                    array_push($conditionArray, ['contacts.bin', '<>', null]);
                } else if ($taxRate === 'non standard' && $transaction_type == 2) {
                    array_push($conditionArray, ['transaction_products.tax_rate', '>', 0]);
                    array_push($conditionArray, ['transaction_products.tax_rate', '<', 15]);
                    // array_push($conditionArray,['contacts.bin','<>',null]);
                } elseif ($taxRate === 'unregistered') {
                    //FOR UNREGISTERED ENTITITIES TAX RATE SHOULD BE < 15
                    array_push($conditionArray, ['transaction_products.tax_rate', '>', 0]);
                    array_push($conditionArray, ['transaction_products.tax_rate', '<', 15]);
                    array_push($conditionArray, ['contacts.bin', '=', null]);
                    // array_push($conditionArray,['transactions.tax_rate','<',15]);
                } else {
                    array_push($conditionArray, ['transaction_products.tax_rate', '=', $taxRate]);
                }
                $query->whereMonth('transactions.transaction_date', date('m', strtotime($date)))
                    ->whereYear('transactions.transaction_date', date('Y', strtotime($date)))
                    ->where($conditionArray);
            })->select('transaction_products.*')->get();
        if (!$transactionProducts) {
            return response()->json(['error' => 'Transaction Not Found'], 404);
        }
        return response()->json(compact('transactionProducts'));
    }

    public function getImportTransactionDetailsInDateRange($entity_id, $note, $fromDate, $toDate, $transaction_type)
    {
        $taxRate      = ReportNinePointOneHelper::getTaxRateViaNote($note);
        $transactionProducts  = TransactionProduct::with(['transaction', 'transaction.contact', 'entity_product'])
            ->join('transactions', 'transaction_products.transaction_id', '=', 'transactions.id')
            ->join('contacts', 'transactions.contact_id', '=', 'contacts.id')
            ->where(function ($query) use ($entity_id, $fromDate, $toDate, $transaction_type, $taxRate) {
                $conditionArray = [
                    ['transactions.entity_id', '=', $entity_id],
                    ['transactions.transaction_date', '>=', $fromDate],
                    ['transactions.transaction_date', '<=', $toDate],
                    ['transactions.transaction_type_id', '=', $transaction_type],
                    ['transactions.transaction_category', '=', 'international'],
                    ['transactions.review_status', '=', 'approved']
                ];
                // if($note == 5)
                // {
                //     array_push($conditionArray,['tax_rate','=',5]);
                //     array_push($conditionArray,['is_MRP','=',1]);
                // }
                if ($taxRate === 'non standard') {
                    //FOR UNREGISTERED entites TAX RATE SHOULD BE < 15
                    array_push($conditionArray, ['transaction_products.tax_rate', '<', 15]);
                    array_push($conditionArray, ['transaction_products.tax_rate', '>', 0]);
                    array_push($conditionArray, ['transaction_products.tax_rate', '!=', 5]);
                    array_push($conditionArray, ['contacts.bin', '<>', null]);
                } elseif ($taxRate === 'unregistered') {
                    array_push($conditionArray, ['transaction_products.tax_rate', '<', 15]);
                    array_push($conditionArray, ['transaction_products.tax_rate', '>', 0]);
                    array_push($conditionArray, ['contacts.bin', '=', null]);
                } else {
                    array_push($conditionArray, ['transaction_products.tax_rate', '=', $taxRate]);
                }
                $query->where($conditionArray);
            })->select('transaction_products.*')->get();
        if (!$transactionProducts) {
            return response()->json(['error' => 'Transaction Product Not Found'], 404);
        }
        return response()->json(compact('transactionProducts'));
    }

    public function getImportTransactionDetailsInDate($entity_id, $note, $date, $transaction_type)
    {
        $taxRate      = ReportNinePointOneHelper::getTaxRateViaNote($note);
        $transactions = TransactionProduct::with(['transaction', 'transaction.contact', 'entity_product'])
            ->join('transactions', 'transaction_products.transaction_id', '=', 'transactions.id')
            ->join('contacts', 'transactions.contact_id', '=', 'contacts.id')
            ->where(function ($query) use ($entity_id, $transaction_type, $date, $taxRate) {
                $conditionArray = [
                    ['transactions.entity_id', '=', $entity_id],
                    ['transactions.transaction_type_id', '=', $transaction_type],
                    ['transactions.transaction_category', '=', 'international'],
                    ['transactions.review_status', '=', 'approved']
                ];
                // if($note == 5){
                //     //FOR MRP CHECKING IF TAX RATE SHOULD BE 5 AND IS_MRP SHOULD BE 1
                //     array_push($conditionArray,['tax_rate','=',5]);
                //     array_push($conditionArray,['is_MRP','=',1]);
                // }
                if ($taxRate === 'non standard') {
                    //FOR NON STANDARD ENTITIES TAX_RATE SHOULD BE > 0 AND < 15
                    array_push($conditionArray, ['transaction_products.tax_rate', '>', 0]);
                    array_push($conditionArray, ['transaction_products.tax_rate', '<', 15]);
                    array_push($conditionArray, ['contacts.bin', '<>', null]);
                } elseif ($taxRate === 'unregistered') {
                    //FOR UNREGISTERED ENTITITIES TAX RATE SHOULD BE < 15
                    array_push($conditionArray, ['transaction_products.tax_rate', '<', 15]);
                    array_push($conditionArray, ['transaction_products.tax_rate', '>', 0]);
                    array_push($conditionArray, ['contacts.bin', '=', null]);
                } else {
                    array_push($conditionArray, ['transaction_products.tax_rate', '=', $taxRate]);
                }
                $query->whereMonth('transactions.transaction_date', date('m', strtotime($date)))
                    ->whereYear('transactions.transaction_date', date('Y', strtotime($date)))
                    ->where($conditionArray);
            })->select('transaction_products.*')->get();
        if (!$transactions) {
            return response()->json(['error' => 'Transaction Not Found'], 404);
        }
        return response()->json(compact('transactions'));
    }

    public function getAdjustmentInDate($entity_id, $date, $adjustment_type)
    {
        $adjustments = VATAdjustment::with('entity', 'transaction','vat')
            ->join('transactions', 'vat_adjustments.transaction_id', '=', 'transactions.id')
            ->where(function ($query) use ($entity_id, $date, $adjustment_type) {
                $conditionArray = [
                    ['vat_adjustments.entity_id', '=', $entity_id],
                    ['vat_adjustments.adjustment_type', '=', $adjustment_type],
                ];
                $query->whereMonth('transactions.transaction_date', date('m', strtotime($date)))
                    ->whereYear('transactions.transaction_date', date('Y', strtotime($date)))
                    ->where($conditionArray);
            })->select('vat_adjustments.*')->get();

        if (!$adjustments) {
            return response()->json(['error' => 'Adjustments Not Found'], 404);
        }
        $adjustments = AdjustmentResource::collection($adjustments);
        return response()->json(compact('adjustments'));
    }

    public function getAdjustmentInDateRange($entity_id, $fromDate, $toDate, $adjustment_type)
    {

        $adjustments = VATAdjustment::with('entity', 'transaction','vat')
            ->join('transactions', 'vat_adjustments.transaction_id', '=', 'transactions.id')
            ->where(function ($query) use ($entity_id, $fromDate, $toDate, $adjustment_type) {
                $conditionArray = [
                    ['vat_adjustments.entity_id', '=', $entity_id],
                    ['vat_adjustments.adjustment_type', '=', $adjustment_type],
                    ['vat_adjustments.adjustment_date', '>=', $fromDate],
                    ['vat_adjustments.adjustment_date', '<=', $toDate]
                ];
                $query->where($conditionArray);
            })->select('vat_adjustments.*')->get();

        if (!$adjustments) {
            return response()->json(['error' => 'Adjustments Not Found'], 404);
        }
        $adjustments = AdjustmentResource::collection($adjustments);
        return response()->json(compact('adjustments'));
    }
}
